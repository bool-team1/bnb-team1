<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function facilities()
    {
        return $this->belongsToMany('App\Facility');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ads()
    {
        return $this->hasMany('App\Ad');
    }

    public function views()
    {
        return $this->hasMany('App\View');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    protected $fillable = ['user_id', 'title','address', 'rooms_n', 'bathrooms_n', 'square_mt', 'slug', 'main_pic', 'longitude', 'latitude'];
}
