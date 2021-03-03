<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return auth()->user()->can('view-category');
    }

    public function view()
    {
        return auth()->user()->can('view-category');
    }

    public function create()
    {
        return auth()->user()->can('create-category');
    }

    public function update()
    {
        return auth()->user()->can('update-category');
    }

    public function delete()
    {
        return auth()->user()->can('delete-category');
    }
}
