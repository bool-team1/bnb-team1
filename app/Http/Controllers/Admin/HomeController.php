<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Braintree;
use Auth;

class HomeController extends Controller
{

    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();
        return view('admin.home', compact('apartments'));
    }
}
