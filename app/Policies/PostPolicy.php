<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view-post');
    }

    public function view(User $user, Post $post): bool
    {
        if ($user->can('view-posts')) {
            return $user->can('view-post');
        }

        return $user->can('view-post') && $user->id == $post->user->id && !$post->isPublished();
    }

    public function create(User $user): bool
    {
        return $user->can('create-post');
    }

    public function update(User $user, Post $post): bool
    {
        if ($user->can('view-posts')) {
            return $user->can('update-post');
        }

        return $user->can('update-post') && $user->id == $post->user->id && !$post->isPublished();
    }

    public function delete(User $user): bool
    {
        return $user->can('delete-post');
    }
}
