<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'articles' => Post::published()->orderBy('publish_at', 'desc')->paginate(12) ?? new Collection()
        ]);
    }

    public function show(Post $post)
    {
        if (!$post->canShow()) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}
