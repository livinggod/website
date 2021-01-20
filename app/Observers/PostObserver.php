<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post)
    {
        $user = auth()->user();
        if ($user->isSuperAdmin()) {
            return;
        }
        $post->user_id = $user->id;
        $post->slug = Str::slug($post->title);
    }
}
