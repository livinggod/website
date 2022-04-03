<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        \App\Models\Page::cursor()->each(fn (\App\Models\Page $page) => $page->update(['url' => ltrim($page->url, '/')]));
    }
};
