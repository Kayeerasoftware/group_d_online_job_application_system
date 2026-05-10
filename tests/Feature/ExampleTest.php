<?php

namespace Tests\Feature;

<<<<<<< HEAD
// use Illuminate\Foundation\Testing\RefreshDatabase;
=======
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
<<<<<<< HEAD
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
=======
     * A basic feature test example.
     */
    public function test_example(): void
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
