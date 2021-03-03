<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return auth()->user()->can('view-post');
    }

    public function view(Post $post): bool
    {
        if (auth()->user()->can('view-posts')) {
            return auth()->user()->can('view-post');
        }

        return auth()->user()->can('view-post') && auth()->user()->id == $post->user->id;
    }

    public function create(): bool
    {
        return auth()->user()->can('create-post');
    }

    public function update(Post $post): bool
    {
        if (auth()->user()->can('view-posts')) {
            return auth()->user()->can('update-post');
        }

        return auth()->user()->can('update-post') && auth()->user()->id == $post->user->id;
    }

    public function delete(): bool
    {
        return auth()->user()->can('delete-post');
    }
}
