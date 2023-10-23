<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PhotoController;

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

/* -------------------------
    User Authentication
--------------------------- */

Route::group(
    ['middleware' => ['UserAuth'], 'prefix' => 'auth'],
    function () {
        Route::post('/register', [UserController::class, 'register'])->name('User.Auth.Register');
        Route::post('/login', [UserController::class, 'login'])->name('User.Auth.Login');
        Route::post('/forget', [UserController::class, 'forget'])->name('User.Auth.Forget');
        Route::post('/reset', [UserController::class, 'reset'])->name('User.Auth.Reset');
    }
);

/* -------------------------
    User Details
--------------------------- */

Route::group(
    ['middleware' => ['UserAuthReq'], 'prefix' => 'profile'],
    function () {
        Route::get('/details', [UserController::class, 'user_details'])->name('User.Profile.Details');
        Route::post('/update', [UserController::class, 'user_profile'])->name('User.Profile.update');
        Route::post('/password', [UserController::class, 'user_password'])->name('User.Profile.Password');
        Route::get('/logout', [UserController::class, 'user_logout'])->name('User.Profile.Logout');
    }
);

/* -------------------------
    Media Controller
--------------------------- */

Route::prefix('media')->group( function () {
    Route::post('/upload', [MediaController::class, 'upload'])->name('User.Media.Upload');
});

/* -------------------------
    Photo Controller
--------------------------- */

Route::prefix('photo')->group( function () {
    Route::post('/create', [PhotoController::class, 'create'])->name('Photo.Create');
    Route::post('/list', [PhotoController::class, 'list'])->name('Photo.List');
    Route::post('/single', [PhotoController::class, 'single'])->name('Photo.Single');
    Route::post('/update', [PhotoController::class, 'update'])->name('Photo.Update');
    Route::post('/delete', [PhotoController::class, 'delete'])->name('Photo.Delete');
} );
