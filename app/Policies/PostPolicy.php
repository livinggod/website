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

    public function view(User $user, Post $post): bool
    {
        if ($user->can('view-posts')) {
            return $user->can('view-post');
        }

        return $user->can('view-post') && $user->id == $post->user->id;
    }

    public function create(): bool
    {
        return auth()->user()->can('create-post');
    }

    public function update(User $user, Post $post): bool
    {
        if ($user->can('view-posts')) {
            return $user->can('update-post');
        }

        return $user->can('update-post') && $user->id == $post->user->id;
    }

    public function delete(): bool
    {
        return auth()->user()->can('delete-post');
    }
}
