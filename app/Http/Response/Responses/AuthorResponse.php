<?php

namespace App\Http\Response\Responses;

use App\Models\User;
use Illuminate\Contracts\View\View;

class AuthorResponse extends BaseResponse
{
    protected ?User $author;

    public function handle(): View
    {
        $this->author->setMeta();

        return view('authors.show', [
            'author'   => $this->author,
            'articles' => $this->author->posts()->published()->localized()->orderBy('publish_at', 'desc')->paginate(8),
        ]);
    }

    public function canHandleSlug(string $slug): bool
    {
        return ($this->author = User::where('slug', $slug)->first()) !== null;
    }
}
