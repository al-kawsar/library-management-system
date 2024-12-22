<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route API
Route::name('api.')->prefix('api')->group(function () {
    Route::apiResources([
        'users' => UserController::class,
        'books' => BookController::class,
        'loans' => LoansController::class
    ]);

    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'doLogin'])->name('login');
        Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');
    });
});

// Route User

Route::get('/', [AuthController::class, 'showFormLogin'])->name('auth.login.index');
// Route Admin
Route::name('admin.')->prefix('admin')->group(function () {

});
