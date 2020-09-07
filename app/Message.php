<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =["apartment_id", "object", "body", "sender", "sender_email"];
    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
