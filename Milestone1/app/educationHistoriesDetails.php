<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class educationHistoriesDetails extends Model
{

    protected $guarded = [];
    //

    public function educationHistory() {
        return $this->belongsTo(educationHistories::class);
    }
}
