<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has a home page', function () {
    Post::factory()->create();

    $this->get(route('page'))->assertStatus(200);
});
