<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Block extends Model
{
    use HasFactory;

    public static function getCachedByCode(string $code): string
    {
        return Cache::rememberForever($code, fn () => optional(Block::firstWhere('code', $code))->content ?? $code);
    }
}
