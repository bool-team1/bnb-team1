<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facility;

class SearchController extends Controller
{
    public function index() {

        $facilities = Facility::all();

        $data = [
            'facilities' => $facilities
        ];

        return view('guest.search', $data);
    }
}
