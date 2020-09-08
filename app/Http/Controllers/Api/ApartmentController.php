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

       $sponsored_index = 0;
       $normal_index = 0;
       $sponsored_results = array ();
       $normal_results = array ();

       $current_date = date('Y-m-d');

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

            //Creating empty array for filters if not specified in Ajax call
            if (!$filters) {
                $filters = array();
            }

            $filter_check = array_intersect($current_apartment['facilities']->toArray(), $filters);

            if (count($filters) == count($filter_check)) {    
                if (($current_apartment['ad_start'] < $current_date) && ($current_apartment['ad_end'] < $current_date)) {

                    $sponsored_results[$sponsored_index] = $current_apartment;

                    $sponsored_index++;
                } 
                else {
                    $normal_results[$normal_index] = $current_apartment; 

                    $normal_index++;
                };               
            };              
       };

       
       return response()->json([
           'success' => true,
           'tot_count' => $search->count(),
           'filtered_count' => count($sponsored_results) + count($normal_results),
           'sponsored_results'=> $sponsored_results,
           'normal_results'=> $normal_results
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