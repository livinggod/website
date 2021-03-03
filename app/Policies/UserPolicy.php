<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $current, User $user)
    {
        return $user->can('edit-user') || $current->id === $user->id;
    }

    public function view(User $current, User $user)
    {
        return $user->can('view-user') || $current->id === $user->id;
    }

    public function create(User $user)
    {
        return $user->can('create-user');
    }
}
