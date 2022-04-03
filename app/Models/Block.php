<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Block extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['content'];

    protected $guarded = [];

    public static function getCachedByCode(string $code): string
    {
        $block = Cache::rememberForever($code, fn () => self::firstWhere('code', $code));

        return $block->content ?? $code;
    }
}
