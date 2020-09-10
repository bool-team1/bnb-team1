<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\Apartment;
use App\View;


class SearchController extends Controller
{
    public function index(Request $request) {
        $longitude =  $request->input('lng');
        $latitude = $request->input('lat');
        $range = $request->input('range');

        $facilities = Facility::all();

        $data = [
            'facilities' => $facilities,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'range' => $range
        ];

        return view('guest.search', $data);
    }

    public function show($id) {

        $apartment = Apartment::find($id);
        $facilities = Apartment::find($id)->facilities()->get()->pluck("type");

        $new_view = new View();
        $new_view->apartment_id = $apartment->id;
        $new_view->save();

        $data = [
            'apartment' => $apartment,
            'facilities' => $facilities
        ];

        return view("guest.detail", $data);
    }
}
