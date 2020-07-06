<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class educationHistories extends Model
{
    protected $guarded = [];

    public function educationHistoriesDetails() {
        return $this->hasMany(educationHistoriesDetails::class);
    }

    public function profile() {
        return $this->belongsTo(profile::class);
    }

    //
}
