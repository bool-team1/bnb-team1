<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Facility;
use App\Helper\Helper;

class ApartmentController extends Controller
{
   

   public function index(Request $request) {
       $longitude =  $request->input('lng');
       $latitude = $request->input('lat');
       $range = $request->input('range');
       $filters = $request->input('filters');

       $search = ApartmentController::findNearestApartments($latitude, $longitude, $range);

       $index = 0;

       foreach ($search as $element) {
        $current_apartment = array(
            'id' => $element->id,
            'title' => $element->title,
            'address' => $element->address,
            'rooms_n' => $element->rooms_n,
            'square_mt' => $element->square_mt,
            'latitude' => $element->latitude,
            'longitude' => $element->longitude,
            'distance' => $element->distance,
            'slug' => $element->slug,
            'main_pic' => $element->main_pic,
            'facilities' => $element->facilities->pluck('type'),
            'ad_start' => $element->ads->last()->start,
            'ad_end' => $element->ads->last()->end
        );

        $search_results[$index] = $current_apartment; 
        
        $index++;
       };

       
       return response()->json([
           'success' => true,
           'count' => $search->count(),
           'filters'=> $filters,
           'results'=> $search_results
       ]);    
   }

   
   public static function findNearestApartments($latitude, $longitude, $radius)
   {
       $current_date = new \DateTime();
       /*
        * using eloquent approach, make sure to replace the "Restaurant" with your actual model name
        * replace 6371000 with 6371 for kilometer and 3956 for miles
        */
       $apartments = Apartment::selectRaw("id, title, address, rooms_n, bathrooms_n, square_mt, latitude, longitude, main_pic,
                        ( 6371 * acos( cos( radians(?) ) *
                          cos( radians( latitude ) )
                          * cos( radians( longitude ) - radians(?)
                          ) + sin( radians(?) ) *
                          sin( radians( latitude ) ) )
                        ) AS distance", [$latitude, $longitude, $latitude])
            ->where('isPublic', '=',1)
           ->having("distance", "<", $radius)
           ->orderBy("distance",'asc')
           ->with('facilities')
           ->with('ads')
           ->get();

       return $apartments;
   }
}