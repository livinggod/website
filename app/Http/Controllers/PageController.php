<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Post;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'posts' => Post::published()->orderBy('publish_at', 'desc')->get()->take(8)
                ->makeHidden(['content', 'published']) ?? new Collection(),
            'highlight' => Post::published()->orderBy('publish_at', 'desc')->first()
                ->makeHidden(['content', 'published']) ?? null,
            'block' => new Block()
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'block' => new Block()
        ]);
    }

    public function abc()
    {
        return view('pages.abc', [
            'block' => new Block()
        ]);
    }
}
