<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    protected $guarded = [];

    public function getProfileImageAttribute($value) {
        return asset('storage/' . $value);
    }


    public function getBannerImageAttribute($value) {
        return asset('storage/' . $value);
    }


    public function users() {
        return $this->belongsToMany(User::class);
    }


    public function isOwner() {
        if (\Auth::user())
            return $this->user_id === \Auth::user()->id;
        else
            return false;

    }
}
