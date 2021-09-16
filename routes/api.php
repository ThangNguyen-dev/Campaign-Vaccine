<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/campaigns', 'Api\ApiController@campaigns');
    Route::get('/organizers/{oSlug}/campaigns/{cSlug}', 'Api\ApiController@campaignsDetail');
    Route::post('login', 'Api\ApiController@login');
    Route::post('logout', 'Api\ApiController@logout');
    Route::get('registrations', 'Api\ApiController@getRegistrations');
});
