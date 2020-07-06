<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobHistories extends Model
{
    //
    protected $guarded = [];

    public function profile() {
        return $this->belongsTo(profile::class);
    }

    public function jobHistoriesDetails() {
        return $this->hasMany(jobHistoriesDetails::class);
    }
}
