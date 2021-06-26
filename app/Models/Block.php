<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Block extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['content'];

    public static function getCachedByCode(string $code): string
    {
        return (Cache::rememberForever($code, fn () => self::firstWhere('code', $code)))->content ?? $code;
    }
}
