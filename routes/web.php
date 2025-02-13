<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;



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

// صفحه اصلی و جستجو
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');


// رزرو فوری
Route::middleware(['auth'])->group(function () {
    Route::post('/reserve/{residence}', [ReservationController::class, 'store'])->name('reserve');
});


// استعلام کاربران
Route::middleware(['auth'])->group(function () {
    Route::get('/inquiries', [InquiryController::class, 'hostInquiries'])->name('inquiries');
    Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
    Route::patch('/inquiries/{inquiry}/approve', [InquiryController::class, 'approve'])->name('inquiries.approve');
});

// پنل میزبان
Route::middleware(['auth', 'host'])->prefix('host')->group(function () {
    Route::get('/dashboard', [HostController::class, 'dashboard'])->name('host.dashboard');
    Route::get('/residences/create', [HostController::class, 'create'])->name('host.residences.create');
    Route::post('/residences', [HostController::class, 'store'])->name('host.residences.store');
    Route::delete('/dashboard/{reserves}', [HostController::class, 'destroy'])->name('residences.destroy');
    Route::post('/logout', [HostController::class, 'logout'])->name('logout');
});

// احراز هویت


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
