<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Redirect;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
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
            'description' => ['en' => 'test', 'nl' => 'test draaien'],
            'content' => ['en' => '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"testing the test"}}],"version":"2.19.0"}', 'nl' => '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"testing the test"}}],"version":"2.19.0"}'],
            'publish_at' => now(),
            'ready' => true,
            'locales' => ['en' => false, 'nl' => true],
        ]);

        App::setLocale('en');
        $this->get('test-draaien')->assertRedirect();

        App::setLocale('en');
        $this->get('test')->assertRedirect();

        App::setLocale('nl');
        $this->get('test-draaien')->assertStatus(200);

        $post->update([
            'locales' => ['en' => true, 'nl' => true],
        ]);

        App::setLocale('en');
        $this->get('test')->assertStatus(200);
    }
}
