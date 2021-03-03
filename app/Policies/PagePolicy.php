<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return auth()->user()->can('view-page');
    }

    public function view()
    {
        return auth()->user()->can('view-page');
    }

    public function create()
    {
        return auth()->user()->can('create-page');
    }

    public function update()
    {
        return auth()->user()->can('update-page');
    }

    public function delete()
    {
        return auth()->user()->can('delete-page');
    }
}
