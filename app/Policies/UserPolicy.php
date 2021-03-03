<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $current, User $user)
    {
        if ($current->can('view-users')) {
            return $current->can('edit-user');
        }

        return $user->can('edit-user') && $current->id === $user->id;
    }

    public function view(User $current, User $user)
    {
        if ($current->can('view-users')) {
            return $current->can('view-user');
        }

        return $user->can('view-user') && $current->id === $user->id;
    }

    public function create(User $user)
    {
        return $user->can('create-user');
    }
}
