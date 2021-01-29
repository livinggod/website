<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'posts' => Post::published()->get()->take(8),
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
