<?php

namespace App\Http\Response\Responses;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class HomeResponse extends BaseResponse
{

    public function handle(): View
    {
        return view('pages.home', [
            'posts' => $this->posts(),
            'highlight' => $this->highlight() ?? null,
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return $slug === '/';
    }

    protected function highlight(): Post
    {
        return Cache::remember('highlight_' . App::currentLocale(), now()->addHour(), function () {

            // TODO: Set highlight per locale
            $highlight = null;
//            $highlight = Post::with(['user', 'topic'])->where('highlight', true)->first();

            if ($highlight === null) { // get latest highlight
                $highlight = Post::with(['user', 'topic'])->localized()->published()->orderBy('publish_at', 'desc')->first()->makeHidden(['content', 'published']);
            }

            return $highlight;
        });
    }

    protected function posts(): Collection
    {
        return Cache::remember('homepage_posts_' . App::currentLocale(), now()->addHour(), function () {
            return Post::with(['user', 'topic'])->published()->localized()->orderBy('publish_at', 'desc')->take(8)->get() ?? new Collection();
        });
    }
}
