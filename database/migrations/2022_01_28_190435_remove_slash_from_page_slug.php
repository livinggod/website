<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        \App\Models\Page::cursor()->each(fn (\App\Models\Page $page) => $page->update(['url' => ltrim($page->url, '/')]));
    }
};
