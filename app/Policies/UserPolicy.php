<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        return $user->can('edit-users');
    }

    public function create(User $user)
    {
        return $user->can('create-users');
    }

    public function viewAny(User $user)
    {
        return $user->can('view-users');
    }
}
