<?php

use Illuminate\Support\Facades\DB;
use App\Models\Professionist\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Professionist\LeadController;
use App\Http\Controllers\Professionist\Profile\ProfileController;
use App\Http\Controllers\Professionist\Profession\ProfessionController;

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

Route::get('/', function () {
    return view('welcome');
});

// REGISTERED USER SECTION
Route::middleware('auth')
    ->name('professionist.')
    ->prefix('professionist')
    ->group(function () {
        Route::get('profile/edit', 'App\Http\Controllers\Professionist\Profile\ProfileController@edit');
        Route::get('profile/show', 'App\Http\Controllers\Professionist\Profile\ProfileController@show');

        Route::post('lead', 'App\Http\Controllers\Professionist\ProfileController@store');
        Route::resource('lead', LeadController::class);
        Route::resource('professions', ProfessionController::class);
        Route::resource('profile', ProfileController::class);
    });




Route::get('/newMessage', function () {
    $profiles = Profile::all();
    $users = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->get();
    return view('newMessage', [
        'profiles'      => $users,

    ]);
});
// Route::post('professionist/lead/store', 'App\Http\Controllers\Professionist\Lead@store')->name('createMessage');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// REGISTERED USER END SECTION



Route::get("{any?}", function () {
    return view("spa");
})->where("any", ".*");
