<?php

use Illuminate\Support\Str;

if (!function_exists('getBlock')) {
    function getBlock(string $code)
    {
        return \App\Models\Block::firstWhere('code', $code)->content ?? $code;
    }
}

if (!function_exists('getLatestPosts')) {
    function getLatestPosts(int $amount = 5)
    {
        return \App\Models\Post::published()->orderBy('publish_at', 'desc')->get()->take($amount);
    }
}

if (!function_exists('limit')) {
    function limit(?string $string = null, int $amount)
    {
        return Str::limit($string, $amount);
    }
}
