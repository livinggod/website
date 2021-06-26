<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Page::cursor()->each(function (Page $page) {
            $page->title = $page->getRawOriginal('title');
            $page->content = $page->getRawOriginal('content');

            $page->saveQuietly();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->json('title')->change();
            $table->json('content')->change();
        });
    }
};
