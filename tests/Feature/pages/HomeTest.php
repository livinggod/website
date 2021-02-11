<?php

namespace Tests\Feature\pages;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_status_loads()
    {
        Post::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
