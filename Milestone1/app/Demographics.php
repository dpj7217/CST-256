<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demographics extends Model
{
    //
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }



    public function getProfileImageLocationAttribute($value) {
        return asset('storage/' . $value);
    }



    public function getBannerImageLocationAttribute($value) {
        return asset('storage/' . $value);
    }
}
