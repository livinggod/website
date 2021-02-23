<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    public function show(User $author)
    {
        return view('authors.show', [
            'author' => $author,
            'articles' => $author->posts()->published()->paginate(8),
        ]);
    }
}
