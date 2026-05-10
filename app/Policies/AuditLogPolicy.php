<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\AuditLog;
use App\Models\User;

class AuditLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function view(User $user, AuditLog $auditLog): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function create(User $user): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function update(User $user, AuditLog $auditLog): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function delete(User $user, AuditLog $auditLog): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function restore(User $user, AuditLog $auditLog): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }

    public function forceDelete(User $user, AuditLog $auditLog): bool
    {
        return $user->roleValue() === UserRole::Admin->value;
    }
}
