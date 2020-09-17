<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Ad;
use App\Apartment;
use DateTime;
use Auth;

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
        $apartment = Apartment::find($_GET['apt_id']);
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

        if (isset($_GET['success'])) {

            return redirect()->route('admin.home', ['success' => 'true']);

        } elseif ($isActive) {

            return redirect()->route('admin.home', ['active_sponsor' => 'true']);

        } elseif ($apartment->user_id != Auth::id()) {
            return redirect()->route('admin.home', ['wrong_user' => 'true']);
        } else {
            return view('admin.sponsor.sponsor', ['token' => $token]);
        }
    }
}
