<?php

use Illuminate\Support\Str;

if (!function_exists('getBlock')) {
    function getBlock(string $code)
    {
        return \Illuminate\Support\Facades\Cache::remember($code, now()->addCentury(), fn () => \App\Models\Block::firstWhere('code', $code)->content ?? $code);
    }
}

if (!function_exists('getLatestPosts')) {
    function getLatestPosts(int $amount = 5)
    {
        return \Illuminate\Support\Facades\Cache::remember('latest_articles_'.$amount, now()->addDay(),
            fn () => \App\Models\Post::published()->orderBy('publish_at', 'desc')->get()->take($amount)
        );
    }
}

if (!function_exists('limit')) {
    function limit(?string $string = null, int $amount)
    {
        return Str::limit($string, $amount);
    }
}

if (!function_exists('store')) {
    function store(string $code)
    {
        return \Spatie\Valuestore\Valuestore::make(storage_path('app/settings.json'))->get($code);
    }
}
