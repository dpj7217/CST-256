<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = [];

    public function educationHistories() {
        return $this->hasOne(educationHistories::class);
    }

    public function jobHistories() {
        return $this->hasOne(jobHistories::class);
    }

    public function demographics() {
        return $this->hasOne(demographics::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
