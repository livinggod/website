<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public $active = false;
    public $search = '';
    public $items = [];

    public function toggle()
    {
        $this->search = '';
        $this->items = collect([]);
        $this->active = !$this->active;
    }

    public function mount()
    {
        $this->items = collect([]);
    }

    public function updatedSearch()
    {
        $this->items = Post::where('title', 'LIKE', "%{$this->search}%")->published()->take(10)->orderBy('publish_at', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.search');
    }
}
