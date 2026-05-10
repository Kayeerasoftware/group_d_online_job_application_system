<?php

namespace Tests\Feature;

use Tests\TestCase;

class JobFlowTest extends TestCase
{
    public function test_jobs_page_is_accessible(): void
    {
        $response = $this->get('/jobs');

        $response->assertStatus(200);
    }
}
