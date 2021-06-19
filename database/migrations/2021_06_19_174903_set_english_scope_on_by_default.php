<?php

use App\Models\Page;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Post::cursor()->each(fn (Post $post) => $post->update(['locales' => ['en' => true]]));
        Topic::cursor()->each(fn (Topic $topic) => $topic->update(['locales' => ['en' => true]]));
        Page::cursor()->each(fn (Page $page) => $page->update(['locales' => ['en' => true]]));
    }
};
