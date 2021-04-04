<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RedirectController extends Controller
{
    public function __invoke(Request $request)
    {
        session()->remove('active');
        $slug = $request->page;
        if ($slug === null) {
            return $this->home();
        }

        if ($slug === 'articles') {
            return $this->articles();
        }

        if ($page = Page::where('url', '/'.$slug)->first()) {
            return view('page', compact('page'));
        }

        if ($post = Post::where('slug', $slug)->first()) {
            if (!$post->canShow()) {
                abort(404);
            }

            session()->flash('active', 'article');

            return view('posts.show', compact('post'));
        }

        if ($topic = Category::where('slug', $slug)->first()) {
            if (is_null($topic->id)) {
                abort(404);
            }

            return view('topics.show', [
                'topic' => $topic,
                'articles' => $topic->articles()->published()->orderBy('publish_at', 'desc')->paginate(8)
            ]);
        }

        if ($author = User::where('slug', $slug)->first()) {
            return view('authors.show', [
                'author' => $author,
                'articles' => $author->posts()->published()->orderBy('publish_at', 'desc')->paginate(8),
            ]);
        }
    }

    public function home()
    {
        $highlight = Post::where('highlight', true)->first();

        if ($highlight === null) {
            $highlight = Post::published()->orderBy('publish_at', 'desc')->first()->makeHidden(['content', 'published']);
        }

        return view('pages.home', [
            'posts' => Post::published()->orderBy('publish_at', 'desc')->get()->take(8)
                    ->makeHidden(['content', 'published']) ?? new Collection(),
            'highlight' => $highlight ?? null,
        ]);
    }

    public function articles()
    {
        return view('posts.index', [
            'articles' => Post::published()->orderBy('publish_at', 'desc')->paginate(12) ?? new Collection()
        ]);
    }
}
