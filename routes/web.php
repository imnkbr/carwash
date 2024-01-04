<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarWashController;

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

Route::get('/',[CarWashController::class,'index']);

Route::get('/reservation',[CarWashController::class,'reservation']);

Route::post('/reservation',[CarWashController::class,'addReservation']);



Route::get('/login',[CarWashController::class,'login']);

Route::post('/login',[CarWashController::class,'loginPost']);

Route::get('login/{code}' , [CarWashController::class , 'showDetails'])->name('login');


Route::get('/login/{code}/edit',[CarWashController::class , 'editDetails'])->name('edit');

Route::put('login/{code}' , [CarWashController::class , 'update'])->name('login');

Route::delete('/login/{id}', [CarWashController::class , 'destroy'])->name('posts.destroy');






