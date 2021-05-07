<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_home_page(): void
    {
        $this->actingAs(User::factory(['super_admin' => true])->create());

        Post::factory()->create();

        $this->get(route('page'))->assertStatus(200);
    }
}
