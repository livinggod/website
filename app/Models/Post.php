<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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

    public function getTitleAttribute(string $title): string
    {
        return ucwords($title);
    }

    public function canShow(): bool
    {
        return $this->isPublished() || optional(auth()->user())->can('see-drafts');
    }

    public function isPublished(): bool
    {
        return !is_null($this->publish_at) && $this->publish_at <= now();
    }

    public function calculateRead(): int
    {
        $words = 0;
        foreach (json_decode($this->content, true)['blocks'] as $block) {
            try {
                $words += count(explode(' ', strip_tags($block['data']['text'])));
            } catch (\Exception $e) {}
        }

        $this->minutes = round($words / store('wordsperminute'), 0, PHP_ROUND_HALF_EVEN);

        return $this->minutes;
    }
}
