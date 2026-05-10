<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Middleware\IsSeeker;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    public function test_suspended_user_is_blocked_by_role_middleware(): void
    {
        $middleware = new IsSeeker();
        $request = Request::create('/seeker/dashboard', 'GET');

        $request->setUserResolver(fn () => new class
        {
            public bool $is_active = false;

            public function isSeeker(): bool
            {
                return true;
            }
        });

        $this->expectException(HttpException::class);

        $middleware->handle($request, fn () => response('ok'));
    }

    public function test_admin_suspend_records_an_audit_log_payload(): void
    {
        $controller = new UserManagementController();
        $request = Request::create('/admin/users/1/suspend', 'PATCH', [
            'reason' => 'Policy violation',
        ]);

        $request->setUserResolver(fn () => new class
        {
            public int $id = 99;
        });

        $user = Mockery::mock(User::class)->makePartial();
        $user->setAttribute('id', 1);
        $user->setAttribute('name', 'Demo Seeker');
        $user->setAttribute('email', 'seeker@example.com');
        $user->setAttribute('is_active', true);
        $user->shouldReceive('roleValue')->andReturn('seeker');
        $user->shouldReceive('update')->once()->with(['is_active' => false])->andReturnTrue();

        $auditLog = Mockery::mock('alias:App\Models\AuditLog');
        $auditLog->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (array $payload): bool {
                return $payload['admin_id'] === 99
                    && $payload['action'] === 'suspend_user'
                    && $payload['target_type'] === User::class
                    && $payload['target_id'] === 1
                    && $payload['reason'] === 'Policy violation'
                    && $payload['old_values']['is_active'] === true
                    && $payload['new_values']['is_active'] === false;
            }))
            ->andReturnTrue();

        $controller->suspend($request, $user);

        $this->addToAssertionCount(1);
    }

    public function test_admin_role_change_records_an_audit_log_payload(): void
    {
        $controller = new UserManagementController();
        $request = Request::create('/admin/users/1/role', 'PATCH', [
            'role' => 'employer',
        ]);

        $request->setUserResolver(fn () => new class
        {
            public int $id = 99;
        });

        $user = Mockery::mock(User::class)->makePartial();
        $user->setAttribute('id', 1);
        $user->setAttribute('name', 'Demo Seeker');
        $user->setAttribute('email', 'seeker@example.com');
        $user->setAttribute('is_active', true);
        $user->shouldReceive('roleValue')->andReturn('seeker');
        $user->shouldReceive('update')->once()->with(['role' => 'employer'])->andReturnTrue();
        $freshUser = Mockery::mock(User::class)->makePartial();
        $freshUser->shouldReceive('roleValue')->andReturn('employer');
        $user->shouldReceive('fresh')->once()->andReturn($freshUser);

        $auditLog = Mockery::mock('alias:App\Models\AuditLog');
        $auditLog->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (array $payload): bool {
                return $payload['admin_id'] === 99
                    && $payload['action'] === 'update_user_role'
                    && $payload['target_type'] === User::class
                    && $payload['target_id'] === 1
                    && $payload['reason'] === 'Role changed from seeker to employer.'
                    && $payload['old_values']['role'] === 'seeker'
                    && $payload['new_values']['role'] === 'employer';
            }))
            ->andReturnTrue();

        $controller->updateRole($request, $user);

        $this->addToAssertionCount(1);
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}
