<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('has a articles page', function () {
    $this->get('/articles')->assertStatus(200);
});

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
    // TODO: MAKE TEST
});
