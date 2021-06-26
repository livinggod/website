<?php

namespace App\Http\Response\Responses;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostResponse extends BaseResponse
{
    protected ?Post $post;

    public function handle(): View
    {
        if (! $this->post->canShow()) {
            abort(404);
        }

        $this->post->setMeta();

        session()->flash('active', 'article');

        return view('posts.show', [
            'post' => $this->post
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return ($this->post = Post::where('slug', $slug)->localized()->first()) !== null;
    }
}
