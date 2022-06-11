<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// VUEJS AXIOS API CALLS
// Route::get('/profiles', [GuestApiController::class, 'index']);

Route::get('profiles', 'App\Http\Controllers\Api\GuestApiController@index');


// Route::post('register', 'RegisterController@register');
// Route::get('login', [AuthenticatedSessionController::class, 'create'])
//     ->name('login');
// Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');
Route::get('/profiles', 'App\Http\Controllers\Api\GuestApiController@index');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
