<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $user->slug = Str::slug($user->name);
    }

    public function updating(User $user)
    {
        $user->slug = Str::slug($user->name);
    }
}
