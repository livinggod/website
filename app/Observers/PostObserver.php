<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class PostObserver
{

    public function creating(Post $post)
    {
        $user = auth()->user();

        if (!app()->runningUnitTests() && explode('.', $post->image)[1] !== 'webp') {
            $post->convertImage();
        }

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

        if (!app()->runningUnitTests() && explode('.', $post->image)[1] !== 'webp') {
            $post->convertImage();
        }

        $user = auth()->user();
        if ($user == null || $user->isSuperAdmin()) {
            return;
        }

        $post->slug = Str::slug($post->title);
    }
}
