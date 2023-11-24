<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Masterdata\UserController;
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
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthUserController::class, 'login'])->name('login');
        Route::post('/register', [AuthUserController::class, 'register'])->name('register');
        Route::middleware('auth:api')->group(function () {
            Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');
            Route::prefix('master-data/user')->group(function () {
                Route::get('/', [UserController::class, 'list'])->name('list-userAuth');
                Route::post('/', [UserController::class, 'store'])->name('store-userAuth');
                Route::put('{id}', [UserController::class, 'update'])->name('update-userAuth');
                Route::delete('{id}', [UserController::class, 'delete'])->name('delete-userAuth');
            });
        });
    });
    Route::prefix('master-data')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'list'])->name('list-user');
            Route::post('/', [UserController::class, 'store'])->name('store-user');
            Route::put('{id}', [UserController::class, 'update'])->name('update-user');
            Route::delete('{id}', [UserController::class, 'delete'])->name('delete-user');
        });
    });
});
