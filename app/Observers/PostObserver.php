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
        $post->calculateRead();

        $this->convertWebp($post);

        $user = auth()->user();
        if ($user == null || $user->isSuperAdmin()) {
            return;
        }
        $post->user_id = $user->id;
    }

    public function updating(Post $post)
    {
        $post->calculateRead();
        $this->convertWebp($post);

        $user = auth()->user();
        if ($user == null || $user->isSuperAdmin()) {
            return;
        }
    }

    protected function convertWebp($post)
    {
        if (! app()->runningUnitTests() && $post->imageIsWebp()) {
            $post->convertImage();
        }
    }
}
