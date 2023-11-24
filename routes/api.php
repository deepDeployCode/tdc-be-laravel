<?php

use App\Http\Controllers\Auth\AuthUserController;
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

//create route api for v1
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthUserController::class, 'login'])->name('login');
        Route::post('/register', [AuthUserController::class, 'register'])->name('register');
        Route::middleware('auth:api')->group(function () {
            Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');
        });
    });
});
