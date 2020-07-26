<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasOne(profile::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function company() {
        return $this->hasMany(Company::class);
    }

    public function isAdmin() {
        if ($this->isAdmin)
            return true;

        return false;
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }


}
