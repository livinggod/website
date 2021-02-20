<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const WORDS_PER_MINUTE = 200;

    protected $guarded = [];

    protected $casts = [
        'publish_at' => 'datetime'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        ''
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('publish_at', '<=', now());
    }

    public function canShow()
    {
        return $this->isPublished() || optional(auth()->user())->can('see_drafts');
    }

    public function isPublished()
    {
        return $this->publish_at <= now();
    }

    public function calculateRead(): int
    {
        $words = 0;
        foreach (json_decode($this->content, true)['blocks'] as $block) {
            try {
                $words += count(explode(' ', strip_tags($block['data']['text'])));
            } catch (\Exception $e) {}
        }

        $this->minutes = round($words / self::WORDS_PER_MINUTE, 0, PHP_ROUND_HALF_EVEN);

        return $this->minutes;
    }
}
