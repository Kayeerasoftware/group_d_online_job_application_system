<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminComplianceTest extends TestCase
{
    public function test_admin_dashboard_route_exists(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(302);
    }
}
