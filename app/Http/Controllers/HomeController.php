<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class HomeController extends Controller
{

    public function index()
    {
        $apartments = Apartment::selectRaw("id, title, address, rooms_n, bathrooms_n, square_mt, latitude, longitude, main_pic")
            ->where('isPublic', '=',1)
           ->with('facilities')
           ->with('ads')
           ->get();
        $sponsored_index = 0;
        $sponsored_results = array();
        $current_date = date('Y-m-d');
        // dd($apartments);

           foreach ($apartments as $element) {
               if(count($element->ads) > 0) {
                   $current_apartment = [
                       'id' => $element->id,
                       'title' => $element->title,
                       'address' => $element->address,
                       'rooms_n' => $element->rooms_n,
                       'square_mt' => $element->square_mt,
                       'latitude' => $element->latitude,
                       'longitude' => $element->longitude,
                       'slug' => $element->slug,
                       'main_pic' => $element->main_pic,
                       'facilities' => $element->facilities->pluck('type'),
                       'ad_start' => $element->ads->last()->start,
                       'ad_end' => $element->ads->last()->end,
                   ];
                   if (($current_apartment['ad_start'] <= $current_date) && ($current_apartment['ad_end'] >= $current_date)) {
                       $sponsored_results[$sponsored_index] = $current_apartment;
                       $sponsored_index++;
                   };
               };
            };
        return view('home', ['sponsored_results' => $sponsored_results]);
    }
}
