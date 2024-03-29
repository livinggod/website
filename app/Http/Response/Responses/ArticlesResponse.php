<?php

namespace App\Http\Response\Responses;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class ArticlesResponse extends BaseResponse
{
    public function handle(): View
    {
        return view('posts.index', [
            'articles' => Post::with('topic', 'user', 'media')->published()->localized()->orderBy('publish_at', 'desc')->paginate(12),
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return $slug === 'articles';
    }
}
