<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Ad;
use App\Plan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    //Rotta di check-out per i pagamenti
    Route::post('/checkout', function(Request $request) {
        date_default_timezone_set('Europe/Rome');

        $plan_id = $request->plan_id;
        $hours_number = Plan::find($plan_id)->hours_n;
        $apartment_id = $request->apt_id;
        $nonce = $request->payment_method_nonce;
        $amount = $request->amount;


        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $data = [
            'apartment_id' => $apartment_id,
            'plan_id' => $plan_id,
            'start' => date('Y-m-d H:i'),
            'end' => date('Y-m-d H:i', strtotime('+' . $hours_number . ' hours')),
        ];
        if ($result->success) {
            $transaction = $result->transaction;
            $new_ad = new Ad();
            $new_ad->fill($data);
            $new_ad->save();
            return back()->with('success_message', 'Transaction successful, transaction ID: '.$transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('An error occured: ' . $result->message);
        }
    });
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'HomeController@index')->name('home');
    Auth::routes();

    //queste sono le rotte pubbliche
    Route::get('/', 'HomeController@index')->name('home');

    //Route to write and send messages to apartment owners
    Route::get('{apartment_id}/send-message', 'MessageController@create')->name("message.create");
    Route::post('{apartment_id}/send-message', 'MessageController@store')->name("message.store");
});


Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function() {
//queste rotte iniziano con admin , sono le pagine della dashboard, navigabili solo con l'autenticazione
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/sponsor', 'SponsorController@index')->name('sponsor/sponsor');
    Route::resource('/apartments', 'ApartmentController');

    //Route to manage messages on the admin side
    Route::get('/messages', 'MessageController@index')->name("message.index");
    Route::get('/messages/{message_id}', 'MessageController@show')->name("message.show");
    Route::delete('/messages/{message_id}', 'MessageController@destroy')->name("message.destroy");
});
