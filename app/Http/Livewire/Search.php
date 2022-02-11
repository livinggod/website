<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public bool $active = false;
    public string $search = '';
    public Collection $items;

    public function mount(): void
    {
        $this->items = new Collection();
    }

    public function toggle(): void
    {
        $this->search = '';
        $this->items = new Collection();
        $this->active = !$this->active;
    }

    public function updatedSearch(): void
    {
        $this->items = Post::with([
            'topic',
            'user',
            'media'
        ])->where('title', 'LIKE', "%{$this->search}%")->published()->orderBy('publish_at', 'desc')->take(10)->get();
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.search');
    }
}
