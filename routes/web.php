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

Route::get('/', function () {
    return view('welcome');
});


// REGISTERED USER SECTION
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::post('/slugger', 'HomeController@slugger')->name('slugger');
        Route::get('/posts/my-posts', 'PostController@myindex')->name('posts.myindex');
        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
        Route::get('/account', 'UserController@edit')->name('account.edit');
        Route::post('/account', 'UserController@update')->name('account.update');
        Route::delete('/account', 'UserController@destroy')->name('account.destroy');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// REGISTERED USER END SECTION



Route::get("{any?}", function () {
    return view("spa");
})->where("any", ".*");
