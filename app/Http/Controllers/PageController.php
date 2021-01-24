<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'posts' => Post::published()->get()->take(4),
        ]);
    }
}
