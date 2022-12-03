<?php

use App\Http\Controllers\PhoneBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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



Route::group(['middleware' => 'auth'], function () {
    Route::resource('/', PhoneBookController::class);
    Route::resource('phone', PhoneBookController::class);
    Route::get('phone.search', [SearchController::class, 'searchPhone'])->name('phone.searchPhone');
    Route::resource('user', ProfileController::class);
});

require __DIR__.'/auth.php';
