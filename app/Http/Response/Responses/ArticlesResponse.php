<?php

namespace App\Http\Response\Responses;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class ArticlesResponse extends BaseResponse
{
    public function handle(): View
    {
        return view('posts.index', [
            'articles' => Post::published()->localized()->orderBy('publish_at', 'desc')->paginate(12) ?? new Collection(),
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return $slug === 'articles';
    }
}