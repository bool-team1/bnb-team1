<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;
use App\Apartment;


class SearchController extends Controller
{
    public function index() {

        $facilities = Facility::all();

        $data = [
            'facilities' => $facilities
        ];

        return view('guest.search', $data);
    }

    public function show($id) {

        $apartment = Apartment::find($id);
        $facilities = Apartment::find($id)->facilities()->get()->pluck("type");

        $data = [
            'apartment' => $apartment,
            'facilities' => $facilities
        ];

        return view("guest.detail", $data);
    }
}
