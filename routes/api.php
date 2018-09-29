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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiresource('/cars', 'CarController');
Route::apiresource('/companies', 'CompanyController');
Route::get('/companies/{company}/cars', 'CompanyController@getCars')->name('company.getCars');
Route::post('/rent', 'RentController@store')->name('rent.store');
Route::get('/rent/{carId}', 'RentController@showCarRents')->name('rent.showCarRents');
Route::get('/next-rent/{car_id}/{date}', 'RentController@nextRentStart')->name('rent.nextRentStart');

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

 