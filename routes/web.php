<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Professionist\Profile\ProfileController;
use App\Http\Controllers\Professionist\Profession\ProfessionController;
use App\Http\Controllers\Professionist\Profession\LeadController;

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
// REGISTERED USER SECTION
Route::middleware('auth')
    ->name('professionist.')
    ->prefix('professionist')
    ->group(function () {
        Route::get('profile/edit', 'App\Http\Controllers\Professionist\Profile\ProfileController@edit');
        Route::get('profile/show', 'App\Http\Controllers\Professionist\Profile\ProfileController@show');

        //lead
        Route::get('lead/index', 'App\Http\Controllers\Professionist\Profile\LeadController@index');

        Route::resource('professions', ProfessionController::class);
        Route::resource('profile', ProfileController::class);
    });


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// REGISTERED USER END SECTION



Route::get("{any?}", function () {
    return view("spa");
})->where("any", ".*");
