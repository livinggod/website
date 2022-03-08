<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post): void
    {
        $user = auth()->user();
        if ($user === null || $user->isSuperAdmin()) {
            return;
        }
        $post->user_id = $user->id;
    }

    public function updating(Post $post): void
    {
        $user = auth()->user();
        if ($user === null || $user->isSuperAdmin()) {
            return;
        }
    }
}
