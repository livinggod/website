<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view-page');
    }

    public function view(User $user): bool
    {
        return $user->can('view-page');
    }

    public function create(User $user): bool
    {
        return $user->can('create-page');
    }

    public function update(User $user): bool
    {
        return $user->can('update-page');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete-page');
    }
}
