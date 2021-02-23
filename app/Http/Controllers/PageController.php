<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        ]);
    }

    public function about()
    {
        return view('page', [
            'page' => Page::firstWhere('url', '/about'),
        ]);
    }

    public function abc()
    {
        return view('page', [
            'page' => Page::firstWhere('url', '/abc'),
        ]);
    }
}
