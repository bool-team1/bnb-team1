<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\View;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.views');
    }
}
