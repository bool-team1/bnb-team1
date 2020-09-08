<?php

use Illuminate\Support\Facades\Route;

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
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'HomeController@index')->name('home');
    Auth::routes();

    //Route to write and send messages to apartment owners
    Route::get('{apartment_id}/send-message', 'MessageController@create')->name("message.create");
    Route::post('{apartment_id}/send-message', 'MessageController@store')->name("message.store");

    //Route to search apartments
    Route::get('/search', "SearchController@index")->name('search');
});


Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function() {
//queste rotte iniziano con admin , sono le pagine della dashboard, navigabili solo con l'autenticazione
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/apartments', 'ApartmentController');

    //Route to manage messages on the admin side
    Route::get('/messages', 'MessageController@index')->name("message.index");
    Route::get('/messages/{message_id}', 'MessageController@show')->name("message.show");
    Route::delete('/messages/{message_id}', 'MessageController@destroy')->name("message.destroy");
});
