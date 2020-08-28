<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
