<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_dynamically_create_pages(): void
    {
        $this->withExceptionHandling();
        $this->get('/page')->assertStatus(404);

        Page::factory()->create([
            'title' => 'Test Page',
            'url' => '/test-page',
        ]);

        $this->get('/test-page')->assertStatus(200)->assertSee('Test Page');
    }
}
