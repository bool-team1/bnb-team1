<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public function show() {
        return $this->belongsToMany('App\Apartment');
    }
}
