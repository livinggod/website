<?php

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
        Schema::rename('categories', 'topics');

        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('category_id', 'topic_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('topic_id')->change()->constrained()->cascadeOnDelete();
        });
    }
};
