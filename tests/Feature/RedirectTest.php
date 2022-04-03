<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_a_post_is_created_any_non_enabled_locales_will_redirect_to_enabled(): void
    {
        /** @var Post $post */
        $post = Post::create([
            'user_id' => User::factory()->create()->id,
            'topic_id' => Topic::factory()->create()->id,
            'image' => 'posts/ddcd1c88-2273-4ead-a2de-04d89e2ec760.jpg',
            'title' => ['en' => 'test', 'nl' => 'test draaien'],
            'slug' => ['en' => 'test', 'nl' => 'test-draaien'],
            'description' => ['en' => 'test', 'nl' => 'test draaien'],
            'content' => ['en' => []],
            'publish_at' => now(),
            'ready' => true,
            'locales' => ['nl'],
        ]);

        $this->get('test-draaien')->assertRedirect();
        $this->get('test')->assertRedirect();

        app()->setLocale('nl');
        $this->get('test-draaien')->assertStatus(200);

        $post->update([
            'locales' => ['en', 'nl'],
        ]);

        app()->setLocale('en');

        $this->get('test')->assertStatus(200);
    }
}
