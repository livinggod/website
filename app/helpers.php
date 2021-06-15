<?php

use App\Models\Block;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Valuestore\Valuestore;

if (!function_exists('getLatestPosts')) {
    function getLatestPosts(int $amount = 5): Collection
    {
        return Cache::remember('latest_articles_' . App::currentLocale() . '_' . $amount, now()->addHour(),
            fn () => Post::published()->localized()->orderBy('publish_at', 'desc')->take($amount)->get()
        );
    }
}

if (!function_exists('store')) {
    function store(string $code): mixed
    {
        return Valuestore::make(storage_path('app/settings.json'))->get($code);
    }
}
