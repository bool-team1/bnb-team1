<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Apartment;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupero le le statistiche delle visualizzazioni
        $statistics = Statistic::with('apartments')->get();
        return view('admin.statistics.index', compact('statistics'));
    }
}
