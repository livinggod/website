<?php

use App\Models\Block;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

// TODO: Create blade directives

if (!function_exists('getBlock')) {
    function getBlock(string $code): string
    {
        return Cache::rememberForever($code, fn () => Block::firstWhere('code', $code)->content ?? $code);
    }
}

if (!function_exists('getLatestPosts')) {
    function getLatestPosts(int $amount = 5): Collection
    {
        return Cache::remember('latest_articles_'.$amount, now()->addHour(),
            fn () => Post::published()->orderBy('publish_at', 'desc')->take($amount)->get()
        );
    }
}

if (!function_exists('limit')) {
    function limit(?string $string, int $amount): ?string
    {
        return Str::limit($string, $amount);
    }
}

if (!function_exists('store')) {
    function store(string $code): mixed
    {
        return Valuestore::make(storage_path('app/settings.json'))->get($code);
    }
}
