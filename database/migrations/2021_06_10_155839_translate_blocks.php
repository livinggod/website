<?php

use App\Models\Block;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Block::cursor()->each(function (Block $block) {
            $block->content = $block->getRawOriginal('content');

            $block->saveQuietly();
        });

        Schema::table('blocks', function (Blueprint $table) {
            $table->json('content')->change();
        });
    }
};
