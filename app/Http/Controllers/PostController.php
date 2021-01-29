<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function show(Post $post)
    {
        if (!$post->canShow()) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}
