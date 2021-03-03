<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'avatar',
        'show_email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'super_admin' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isSuperAdmin()
    {
        return $this->super_admin;
    }

    public function getAvatar()
    {
        return !is_null($this->attributes['avatar'])
            ? asset('storage/' . $this->attributes['avatar'])
            : 'https://eu.ui-avatars.com/api/?background=59B100&color=fff&name=' . $this->attributes['name'];
    }
}
