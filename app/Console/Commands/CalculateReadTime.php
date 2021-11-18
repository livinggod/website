<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class CalculateReadTime extends Command
{
    protected $signature = 'post:calculate-minutes';

    protected $description = 'Calculate the read minutes for each post';

    public function handle(): int
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->calculateRead();
            $post->save();
        }

        return self::SUCCESS;
    }
}
