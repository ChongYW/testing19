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

// prevent-back-history(cyw, s)
Route::group(['middleware' => 'prevent-back-history'],function(){

    Route::get('/', function () {
    return view('welcome');
    });

    Auth::routes(['verify' => true]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'showProfile'])->name('profile');

    Route::get('/edit_profile', [App\Http\Controllers\ProfileController::class, 'showEditProfile'])->name('edit_profile');

    Route::put('/update_profile', [App\Http\Controllers\ProfileController::class, 'updateProfile']);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'showWallet']);

    Route::get('/top_up_page', function () {
        return view('top_up');
    });

    Route::put('/topUp', [App\Http\Controllers\TopUpController::class, 'topUp']);


});
// prevent-back-history(cyw, e)
