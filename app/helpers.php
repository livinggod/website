<?php

if (!function_exists('getBlock')) {
    function getBlock(string $code)
    {
        return \App\Models\Block::firstWhere('code', $code)->content ?? $code;
    }
}
