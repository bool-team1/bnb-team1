<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function apartments()
    {
        return $this->belongsTo('App\Apartment');
    }
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
