<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GlobalController;

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
    Photo Controller
--------------------------- */

Route::prefix('global')->group( function () {
    Route::post('/list', [GlobalController::class, 'list'])->name('Global.Photo.List');
    Route::post('/single', [GlobalController::class, 'single'])->name('Global.Photo.Single');
} );
