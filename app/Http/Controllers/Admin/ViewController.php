<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\View;
use App\Apartment;
use App\User;
use Auth;


class ViewController extends Controller
{
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();

        return view('admin.views.index', ['apartments' => $apartments]);
    }
}
