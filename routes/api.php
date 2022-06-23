<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuestApiController;
use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\ProfessionistApiController;
use App\Http\Controllers\Api\Orders\SponsorshipController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
// VUEJS AXIOS API CALLS TECHNICAL
Route::get('/sponsorship', [SponsorshipController::class, 'index']);
Route::get('/profiles', [GuestApiController::class, 'index']);
Route::get('/authcheck', [GuestApiController::class, 'authcheck']);
Route::get('/unique', [GuestApiController::class, 'isUnique']);




Route::get('orders/generate', [OrderController::class, 'generate']);
Route::post('orders/makepayment', [OrderController::class, 'makePayment'])->name('pay');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






// FRONTENDAPI CALLS

Route::get('/getBundles', [ProfessionistApiController::class, 'getBundle']);
Route::get('/profile/{id}', [ProfessionistApiController::class, 'getProfileInfo']);

// FRONTENTD LENDING PAGE 
Route::get('/landingPage', [GuestApiController::class, 'landingPage']);
Route::get('/getSearchInfo', [GuestApiController::class, 'getSearchInfo']);
Route::post('/customFilter', [GuestApiController::class, 'customFilter']);
Route::get('/getProfInfo', [GuestApiController::class, 'getProfInfo']);
Route::get('/cityUser', [GuestApiController::class, 'cityUser']); // FATTO
Route::get('/promotedUser', [GuestApiController::class, 'promotedUser']); //FATTO
Route::get('/bannerUser', [GuestApiController::class, 'bannerUser']); //FATTO
