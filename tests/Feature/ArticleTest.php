<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_has_a_articles_page()
    {
        $this->get('/articles')->assertStatus(200);
    }

    /** @test */
    public function it_meets_publishing_requirements(): void
    {
        $this->actingAs(User::factory(['super_admin' => true])->create());

        $article = Post::factory()->create([
            'publish_at' => now()->addDay(),
            'ready' => false,
        ]);

        $this->assertFalse($article->isPublished());

        $article->update(['ready' => true]);

        $this->assertFalse($article->isPublished());

        $article->update(['publish_at' => now()->subDay()]);

        $this->assertTrue($article->isPublished());

        $article->update(['ready' => false]);

        $this->assertFalse($article->isPublished());
    }

    protected function fakeEditorJS(string $content): string
    {
        return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"'.$content.'"}}],"version":"2.19.0"}';
    }
}
