<?php

use App\Http\Controllers\Api\V1\CreatApiUserController;
use App\Http\Controllers\Api\V1\PhoneBookApiController;
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

Route::prefix('v1')->group(function () {
    Route::post('create-user', [CreatApiUserController::class, 'createUserController']);
    Route::post('create-token', [CreatApiUserController::class, 'createUserToken']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('add-contact', [PhoneBookApiController::class, 'store']);
    Route::get('get-contacts', [PhoneBookApiController::class, 'index']);
    Route::post('search-contacts', [PhoneBookApiController::class, 'searchContact']);
    Route::get('get-contact/{id}', [PhoneBookApiController::class, 'show']);
    Route::put('update-contact/{id}', [PhoneBookApiController::class, 'update']);
    Route::delete('delete-contact/{id}', [PhoneBookApiController::class, 'destroy']);
});
