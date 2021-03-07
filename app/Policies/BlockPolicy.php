<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return auth()->user()->can('view-block');
    }

    public function view()
    {
        return auth()->user()->can('view-block');
    }

    public function create()
    {
        return auth()->user()->can('create-block');
    }

    public function update()
    {
        return auth()->user()->can('update-block');
    }

    public function delete()
    {
        return auth()->user()->can('delete-block');
    }
}
