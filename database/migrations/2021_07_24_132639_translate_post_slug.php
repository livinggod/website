<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Post::cursor()->each(function (Post $post) {
            $post->slug = $post->getRawOriginal('slug');

            $post->saveQuietly();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->json('slug')->change();
        });
    }
};
