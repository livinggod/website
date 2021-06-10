<?php

use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Topic::cursor()->each(function (Topic $topic) {
            $topic->name = $topic->getRawOriginal('name');
            $topic->description = $topic->getRawOriginal('description');

            $topic->saveQuietly();
        });

        Schema::table('topics', function (Blueprint $table) {
            $table->json('name')->change();
            $table->json('description')->nullable()->change();
        });
    }
};
