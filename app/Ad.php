<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['apartment_id', 'plan_id', 'start', 'end'];
    public function apartments()
    {
        return $this->belongsTo('App\Apartment');
    }
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
