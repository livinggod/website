<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public bool $active = false;
    public string $search = '';
    public Collection $items;

    public function mount()
    {
        $this->items = new Collection();
    }

    public function toggle()
    {
        $this->search = '';
        $this->items = new Collection();
        $this->active = !$this->active;
    }

    public function updatedSearch()
    {
        $this->items = Post::where('title', 'LIKE', "%{$this->search}%")->published()->orderBy('publish_at', 'desc')->take(10)->get();
    }

    public function render()
    {
        return view('livewire.search');
    }
}
