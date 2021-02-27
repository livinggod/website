<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $current, User $user)
    {
        return $user->isSuperAdmin() || $user->can('edit-users') || $current->id === $user->id;
    }

    public function view(User $current, User $user)
    {
        return $user->isSuperAdmin() || $user->can('view-users') || $current->id === $user->id;
    }

    public function create(User $user)
    {
        return $user->can('create-users');
    }
}
