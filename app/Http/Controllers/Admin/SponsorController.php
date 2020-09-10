<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Ad;
use App\Apartment;
use DateTime;

class SponsorController extends Controller
{

    public function index()
    {
        $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        // Check if apt has already an active sponsor
        $ads = Ad::all();
        $data = $ads->where('apartment_id', $_GET['apt_id']);
        date_default_timezone_set('Europe/Rome');
        $isActive = false;
        foreach ($data as $ad) {
            $end_date = new DateTime($ad->end);
            $now_date = new DateTime('now');
            $difference = $now_date->diff($end_date);
            if ($difference->invert == 0) {
                $isActive = true;
            }
        }

        // //Check if the Auth::user owns apt to sponsor
        // $apartment = Apartment::where('id', $_GET['apt_id']);
        if ($isActive) {
            return redirect()->route('admin.home');
        } else {
            return view('admin.sponsor.sponsor', ['token' => $token]);
        }
    }
}
