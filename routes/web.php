<?php

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

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::resource('/', 'CampaignController');
Route::resource('/campaign', 'CampaignController');

Route::group(['prefix' => 'campaign/{campaign}/'], function () {
    Route::resource('ticket', 'Campaign_ticketController');
    Route::resource('session', 'SessionController');
    Route::resource('area', 'AreaController');
    Route::resource('place', 'PlaceController');
});
