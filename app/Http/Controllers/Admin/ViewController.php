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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::User();
        $views = $user->apartments()->with('views')->get();

        $data = [
                'views' => $views,
                'user' => $user
                ];

        return view('admin.views.index', $data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = View::find($id);
        $apartment = Apartment::find($view->apartment_id);

        $data = [
            "view" => $view,
            "apartment" => $apartment
        ];

        return view("admin.views.show", $data);
    }
}
