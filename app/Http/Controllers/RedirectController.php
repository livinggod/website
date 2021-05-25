<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    public function __invoke(Request $request, ?string $slug = '/'): ?View
    {
        session()->remove('active');

        if ($slug === '/') {
            return $this->home();
        }

        if ($slug === 'articles') {
            return $this->articles();
        }

        if ($post = Post::where('slug', $slug)->first()) {
            if (! $post->canShow()) {
                abort(403);
            }

            $post->setMeta();

            session()->flash('active', 'article');

            return view('posts.show', compact('post'));
        }

        if ($page = Page::where('url', '/'.$slug)->first()) {
            $page->setMeta();
            return view('page', compact('page'));
        }

        if ($topic = Topic::where('slug', $slug)->first()) {

            $topic->setMeta();

            return view('topics.show', [
                'topic' => $topic,
                'articles' => $topic->articles()->published()->orderBy('publish_at', 'desc')->paginate(8),
            ]);
        }

        if ($author = User::where('slug', $slug)->first()) {

            $author->setMeta();

            return view('authors.show', [
                'author' => $author,
                'articles' => $author->posts()->published()->orderBy('publish_at', 'desc')->paginate(8),
            ]);
        }

        abort(404);
    }

    public function home(): View
    {
        $highlight = Cache::remember('highlight', now()->addHour(), function () {
            $highlight = Post::with(['user', 'topic'])->where('highlight', true)->first();

            if ($highlight === null) { // get latest highlight
                $highlight = Post::with(['user', 'topic'])->published()->orderBy('publish_at', 'desc')->first()->makeHidden(['content', 'published']);
            }

            return $highlight;
        });

        $posts = Cache::remember('homepage_posts', now()->addHour(), function () {
            return Post::with(['user', 'topic'])->published()->orderBy('publish_at', 'desc')->take(8)->get() ?? new Collection();
        });


        return view('pages.home', [
            'posts' => $posts,
            'highlight' => $highlight ?? null,
        ]);
    }

    public function articles(): View
    {
        return view('posts.index', [
            'articles' => Post::published()->orderBy('publish_at', 'desc')->paginate(12) ?? new Collection(),
        ]);
    }
}
