<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can dynamically create pages', function () {
    $this->get('/page')->assertStatus(404);

    \App\Models\Page::factory()->create([
        'title' => 'Test Page',
        'url' => '/test-page'
    ]);

    $this->get('/test-page')->assertStatus(200)->assertSee('Test Page');
});
