<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\View;
use App\User;
use App\Message;
use App\Apartment;

class ViewController extends Controller
{
    public function index(Request $request) {
        //Get user_id via api url
        $user_id = $request->input('user_id');

        $wannaBeJson = [];

        $apartments = Apartment::where('user_id', $user_id)->get();

            foreach ($apartments as $apartment) {
                $apt_array = ['apt_title' => $apartment->title];
                $msg_months_array = [];
                $views_months_array = [];

                //Crea un array che salva il mese di ogni messaggio ES: [08, 01, 08, 08, 12, 12, 04]
                foreach ($apartment->messages as $message) {
                    $month = substr($message->created_at, 5, 2);
                    if (substr($message->created_at, 5, 1) == '0') {
                        $month = substr($message->created_at, 6, 1);
                    }
                    array_push($msg_months_array, $month);
                }



                //Raggruppa i valori uguali di $msg_months_array E LI CONTA per poi creare un array assoc.
                $count_msg_array = array_count_values($msg_months_array);


                //Pusha l'array $count_msg_array(conteggio messaggi/mese) dentro all'array dell'appartamento
                $apt_array['msg_per_month'] = $count_msg_array;


                //Crea un array che salva il mese di ogni view ES: [08, 01, 08, 08, 12, 12, 04]
                foreach ($apartment->views as $view) {
                    $month = substr($view->created_at, 5, 2);
                    if (substr($view->created_at, 5, 1) == '0') {
                        $month = substr($view->created_at, 6, 1);
                    }
                    array_push($views_months_array, $month);
                }

                //Raggruppa i valori uguali di $views_months_array E LI CONTA per poi creare un array assoc.
                $count_views_array = array_count_values($views_months_array);

                //Pusha l'array $count_views_array(conteggio views/mese) dentro all'array dell'appartamento
                $apt_array['views_per_month'] = $count_views_array;

                //Pusha l'array dell'appartamento nell'array di tutti gli appartamenti
                array_push($wannaBeJson, $apt_array);
            }
            return response()->json([
                'success' => true,
                'apts_array' => $wannaBeJson
            ]);
    }
}
