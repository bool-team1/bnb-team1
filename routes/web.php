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
        // return back();
        return redirect()->route('admin.sponsor', ['success' => 'true', 'apt_id' => $apartment_id]);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        return back()->withErrors('An error occured: ' . $result->message);
    }
});

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

// Route to write and send messages to apartment owners
Route::get('{apartment_id}/send-message', 'MessageController@create')->name("message.create");
Route::post('{apartment_id}/send-message', 'MessageController@store')->name("message.store");

//Route to search and view apartments
Route::get('/search', "SearchController@index")->name('search');
Route::get('/{apartment_id}/detail', "SearchController@show")->name('detail');


Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function() {
//queste rotte iniziano con admin , sono le pagine della dashboard, navigabili solo con l'autenticazione
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/sponsor', 'SponsorController@index')->name('sponsor');
    Route::get('/views', 'ViewController@index')->name('views');
    Route::resource('/apartments', 'ApartmentController');
    //Route to manage messages on the admin side
    Route::get('/messages', 'MessageController@index')->name("message.index");
    Route::get('/messages/{message_id}', 'MessageController@show')->name("message.show");
    Route::delete('/messages/{message_id}', 'MessageController@destroy')->name("message.destroy");
});
