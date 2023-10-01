<?php

use App\Http\Controllers\Users\Auth\LoginController;
use App\Http\Controllers\Admins\Auth\LoginController as LoginAdminController;
use App\Http\Controllers\Users\UserController;
use \App\Http\Controllers\Users\Auth\ProfileController;
use \App\Http\Controllers\Admins\Auth\ProfileController as ProfileAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| API Routes Users
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {
    Route::post('/auth/login', [LoginController::class, 'login'])->name('user.auth.login');
    Route::post('/auth/refresh', [LoginController::class, 'refresh'])->name('user.auth.refresh');
    Route::middleware(['auth:user'])->group(function () {
        Route::post('/auth/logout', [LoginController::class, 'logout'])->name('user.auth.logout');
        Route::get('/auth/me', [ProfileController::class, 'me'])->name('user.auth.me');
        Route::get('/list', [UserController::class, 'getListUser'])->name('user.getListUser');
        Route::put('/auth/me', [ProfileController::class, 'updateMe'])->name('user.auth.updateMe');
    });
});

/*
|--------------------------------------------------------------------------
| API Routes Admins
|--------------------------------------------------------------------------
*/
Route::prefix('admins')->group(function () {
    Route::post('/auth/login', [LoginAdminController::class, 'login'])->name('admin.auth.login');
    Route::post('/auth/refresh', [LoginAdminController::class, 'refresh'])->name('user.auth.refresh');
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/auth/logout', [LoginAdminController::class, 'logout'])->name('admin.auth.logout');
        Route::get('/auth/me', [ProfileAdminController::class, 'me'])->name('admin.auth.me');
        Route::put('/auth/me', [ProfileAdminController::class, 'updateMe'])->name('admin.auth.updateMe');
    });
});
