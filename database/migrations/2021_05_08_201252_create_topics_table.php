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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique()->default('');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('categories')
            ->orderBy('created_at')
            ->get()
            ->each(fn ($category) => \App\Models\Topic::create([
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
        ]));

        Schema::dropIfExists('categories');
    }
};
