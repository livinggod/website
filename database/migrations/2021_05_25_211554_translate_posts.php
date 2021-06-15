<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Post::cursor()->each(function (Post $post) {
            $post->title = $post->getRawOriginal('title');
            $post->description = $post->getRawOriginal('description');
            $post->content = $post->getRawOriginal('content');

            $post->saveQuietly();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
            $table->json('description')->nullable()->change();
        });
    }
//
//    public function down()
//    {
//        Schema::table('posts', function (Blueprint $table) {
//            $table->json('title')->change();
//            $table->json('content')->change();
//            $table->json('description')->nullable()->change();
//        });
//    }
};
