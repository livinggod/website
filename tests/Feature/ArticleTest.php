<?php

use function Pest\Faker\faker;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has a articles page')
    ->get('/articles')
    ->assertStatus(200);

it('meets publishing requirements', function () {
    $article = \App\Models\Post::factory()->create([
        'publish_at' => now()->addDay(),
        'ready' => false,
    ]);

    expect($article->isPublished())->toBeFalse();

    $article->update(['ready' => true]);

    expect($article->isPublished())->toBeFalse();

    $article->update(['publish_at' => now()->subDay()]);

    expect($article->isPublished())->toBeTrue();

    $article->update(['ready' => false]);

    expect($article->isPublished())->toBeFalse();
});

it('calculates read minutes', function () {
    $article = \App\Models\Post::factory()->create([
        'content' => fakeEditorJS(faker()->text(10000)),
    ]);

    expect($oldMinutes = $article->minutes)->toBeInt()->toBeGreaterThan(1);

    $article->update([
        'content' => fakeEditorJS(faker()->text(100000)),
    ]);

    expect($article->fresh()->minutes)->not->toBe($oldMinutes);
});

function fakeEditorJS(string $content): string
{
    return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"'.$content.'"}}],"version":"2.19.0"}';
}
