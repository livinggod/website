<?php

namespace App\Models;

use App\Traits\ConvertsToWebp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, ConvertsToWebp;

    const WORDS_PER_MINUTE_FALLBACK = 150;

    protected $guarded = [];

    protected $casts = [
        'publish_at' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where([['publish_at', '<=', now()], ['ready', true]]);
    }

    public function getTitleAttribute(?string $title): ?string
    {
        return ucwords($title);
    }

    public function canShow(): bool
    {
        return $this->isPublished() || optional(auth()->user())->can('see-drafts');
    }

    public function isPublished(): bool
    {
        return !is_null($this->publish_at) && $this->publish_at <= now() && $this->ready;
    }

    public function calculateRead(): int
    {
        $words = 0;
        foreach (optional(json_decode($this->content, true))['blocks'] ?? [] as $block) {
            try {
                $words += count(explode(' ', strip_tags($block['data']['text'])));
            } catch (\Exception $e) {}
        }

        if ($words === 0) {
            return 0;
        }

        $this->minutes = (int)round($words / (store('wordsperminute') ?? self::WORDS_PER_MINUTE_FALLBACK), 0, PHP_ROUND_HALF_EVEN);

        return $this->minutes;
    }
}
