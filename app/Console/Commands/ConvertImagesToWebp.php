<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp';

    protected $description = 'Convert all images to webp';

    public function handle(): int
    {
        Post::cursor()->each(fn ($post) => $post->imageExists() && $post->imageIsWebp() ?: $post->convertImage());
        User::cursor()->each(fn ($user) => $user->imageExists() && $user->imageIsWebp() ?: $user->convertImage());
        Page::cursor()->each(fn ($page) => $page->imageExists() && $page->imageIsWebp() ?: $page->convertImage());

        return self::SUCCESS;
    }
}
