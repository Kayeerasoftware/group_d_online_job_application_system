<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApplicationFlowTest extends TestCase
{
    public function test_applications_page_redirects_guests_to_login(): void
    {
        $response = $this->get('/applications');

        $response->assertStatus(302);
    }
}
