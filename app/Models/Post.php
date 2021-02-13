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

    public function canShow()
    {
        return $this->isPublished() || optional(auth()->user())->can('see_drafts');
    }

    public function isPublished()
    {
        return $this->publish_at <= now();
    }
}
