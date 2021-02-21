<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function __invoke($page = 'home')
    {
        if ($page === 'home') {
            return $this->home();
        }

        $content =  Page::firstWhere('url', '/' . $page);

        if (is_null($content)) {
            abort(404);
        }

        return view('page', [
            'page' => $content,
        ]);
    }

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
        return view('pages.about');
    }

    public function abc()
    {
        return view('pages.abc');
    }
}
