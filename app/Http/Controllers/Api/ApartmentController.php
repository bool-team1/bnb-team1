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
       $longitude =  $request->input('lon');
       $latitude = $request->input('lat');
       $range = $request->input('range');

       $apartments = Apartment::with('facilities')->get();

       $search = ApartmentController::findNearestApartments($latitude, $longitude, $range);
       
       return response()->json([
           'success' => true,
           'count' => $apartments->count(),
           'data'=> $apartments,
           'data2'=> $longitude,  
           'data3' => $search
       ]);    
   }

   
   public static function findNearestApartments($latitude, $longitude, $radius)
   {
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
           ->get()
           ->flatten();

       return $apartments;
   }
}