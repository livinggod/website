<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view-category');
    }

    public function view(User $user): bool
    {
        return $user->can('view-category');
    }

    public function create(User $user): bool
    {
        return $user->can('create-category');
    }

    public function update(User $user): bool
    {
        return $user->can('update-category');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete-category');
    }
}
