<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ReserveTimeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[UserController::class,'index'])->name('home');

Route::get('/register',[AuthController::class,'register'])->name('register');

Route::post('/register',[AuthController::class,'registeration']);

/* Route::get('/reserve-time/{code}', [CarWashController::class, 'addReservation'])->name('reserve-time'); */



Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login',[AuthController::class,'loginRequest']);

Route::middleware('user')->group(function () {
    Route::get('/reservation',[ReserveTimeController::class,'reservation'])->name('reserve');

    Route::post('/reservation',[ReserveTimeController::class,'addReservation']);

    Route::get('/details/{id}',[UserController::class,'showDetails'])->name('details');

    Route::get('/details/{user_id}/edit/{time_id}',[UserController::class,'editDetails'])->name('edit');

    Route::put('/details/{user_id}/{time_id}',[UserController::class,'update'])->name('update');

    Route::delete('/details/{id}', [UserController::class , 'destroy'])->name('destroy');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Other routes...;
});
Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class,'index']);

    Route::get('/reservedtimes', [AdminController::class,'reservedTimes'])->name('reservedTimes');

    Route::get('/reservedtimes', [AdminController::class,'reservedTimesFilter'])->name('reservedTimes');

    Route::get('/users', [AdminController::class,'userDetails']);

    Route::get('/washtypes',[AdminController::class,'washType'])->name('washtype');

    Route::get('/washtypes/add',[AdminController::class,'addWashType'])->name('addwashtype');

    Route::post('/washtypes/add',[AdminController::class,'createWashType']);

    Route::get('/washtypes/{id}/edit',[AdminController::class,'editWashType'])->name('edit');

    Route::put('/details/{id}',[AdminController::class,'updateWashType'])->name('update');

    Route::delete('/details/{id}', [AdminController::class , 'destroy'])->name('destroy');






    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



/* Route::get('reservation',[CarWashController::class,'reservation'])->middleware('user'); */

/* Route::get('login/{id}' , [CarWashController::class , 'showDetails'])->name('login');


Route::get('/login/{code}/edit',[CarWashController::class , 'editDetails'])->name('edit');

Route::put('login/{code}' , [CarWashController::class , 'update'])->name('login');

Route::delete('/login/{id}', [CarWashController::class , 'destroy'])->name('posts.destroy');

Route::post('login/', [CarWashController::class , 'loginRequest'])->name('loginreq');;
 */




