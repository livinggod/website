<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_home_page(): void
    {
        Post::factory()->create();

        $this->get(route('page'))->assertStatus(200);
    }
}
