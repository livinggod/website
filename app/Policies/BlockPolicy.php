<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return auth()->user()->can('view-block');
    }

    public function view(): bool
    {
        return auth()->user()->can('view-block');
    }

    public function create(): bool
    {
        return auth()->user()->can('create-block');
    }

    public function update(): bool
    {
        return auth()->user()->can('update-block');
    }

    public function delete(): bool
    {
        return auth()->user()->can('delete-block');
    }
}
