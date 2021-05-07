<?php

namespace Tests\Feature;

use App\Http\Livewire\Search;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Livewire\Livewire;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_be_toggled(): void
    {
        Livewire::test(Search::class)
            ->assertSet('active', false)
            ->assertDontSeeHtml('<input')
            ->call('toggle')
            ->assertSet('active', true)
            ->assertSeeHtml('<input')
            ->call('toggle')
            ->assertSet('active', false)
            ->assertDontSeeHtml('<input');
    }

    /** @test */
    public function toggling_clears_the_inputs(): void
    {
        Livewire::test(Search::class)
            ->assertSet('search', '')
            ->call('toggle')
            ->assertSet('search', '')
            ->set('search', '::string::')
            ->assertSet('search', '::string::')
            ->call('toggle')
            ->assertSet('search', '');
    }

    /** @test */
    public function it_can_search_for_posts(): void
    {
        $this->actingAs(User::factory(['super_admin' => true])->create());

        Post::factory()->create([
            'title' => 'Test Post',
        ]);

        Livewire::test(Search::class)
            ->assertSet('items', new Collection())
            ->assertDontSee('Test Post')
            ->call('toggle')
            ->set('search', 'tes')
            ->assertNotSet('items', new Collection())
            ->assertSee('Test Post')
            ->set('search', '::string::')
            ->assertDontSee('Test Post')
            ->call('toggle')
            ->assertDontSee('Test Post')
            ->assertSet('items', new Collection());
    }
}
