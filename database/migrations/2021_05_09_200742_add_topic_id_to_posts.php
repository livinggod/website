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
        Schema::table('posts', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::transaction(function () use ($table) {
                $table->renameColumn('category_id', 'topic_id');

                $table->foreign('topic_id')->references('id')->on('topics');
            });
        });
    }
};
