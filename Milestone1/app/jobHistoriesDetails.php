<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobHistoriesDetails extends Model
{
    protected $guarded = [];

    //

    public function jobHistories() {
        return $this->belongsTo(jobHistories::class);
    }
}
