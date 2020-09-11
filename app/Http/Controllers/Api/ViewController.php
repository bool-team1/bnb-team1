<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class ViewController extends Controller
{
    public function index() {
        $apartments = Apartment::all();
        return response()->json(['data' => $apartments]);
    }
}
