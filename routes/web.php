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



Auth::routes();
//queste sono le rotte pubbliche
Route::get('/', 'HomeController@index')->name('home');
<<<<<<< HEAD
=======
Route::get('/search', function () {
    return view('search');
});
>>>>>>> master

Route::prefix('admin')->namespace('Admin')->name('admin.')->middleware('auth')->group(function() {
//queste rotte iniziano con admin , sono le pagine della dashboard, navigabili solo con l'autenticazione
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/apartments', 'ApartmentController');

});
