<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Ad;
use Braintree;
use Auth;

class HomeController extends Controller
{

    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        $ads = Ad::all();
        return view('admin.home', [
            'apartments' => $apartments,
            'ads' => $ads,
        ]);
    }
}
