<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    const WORDS_PER_MINUTE = 250;

    public function creating(Post $post)
    {
        $user = auth()->user();

        $post->minutes = $this->calculateRead($post);

        if ($user == null || $user->isSuperAdmin()) {
            return;
        }
        $post->user_id = $user->id;
        $post->slug = Str::slug($post->title);
    }

    public function updating(Post $post)
    {
        $post->minutes = $this->calculateRead($post);
    }

    protected function calculateRead(Post $post): int
    {
        return round(count(explode(' ', strip_tags($post->content))) / self::WORDS_PER_MINUTE, 0, PHP_ROUND_HALF_EVEN);
    }
}
