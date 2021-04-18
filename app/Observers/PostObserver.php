<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{

    public function creating(Post $post)
    {
        $user = auth()->user();

        $post->calculateRead();

        if ($user == null || $user->isSuperAdmin()) {
            return;
        }
        $post->user_id = $user->id;
        $post->slug = Str::slug($post->title);
    }

    public function updating(Post $post)
    {
        $post->calculateRead();

        $user = auth()->user();
        if ($user == null || $user->isSuperAdmin()) {
            return;
        }

        $post->slug = Str::slug($post->title);
    }
}
