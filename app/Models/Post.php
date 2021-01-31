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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function canShow()
    {
        return $this->isPublished() || optional(auth()->user())->can('see_drafts');
    }

    public function isPublished()
    {
        return $this->published == 1;
    }
}
