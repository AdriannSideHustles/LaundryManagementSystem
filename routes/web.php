<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Equipment;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard',[HomeController::class,'admin']) -> middleware(['auth','verified','admin']);
Route::resource('service', ServiceController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('equipment', EquipmentController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified', 'admin']);


Route::get('staff/dashboard',[HomeController::class,'staff']) -> middleware(['auth','verified','staff']);

Route::get('customer/dashboard',[HomeController::class,'customer']) -> middleware(['auth','verified','customer'])->name('customer.dashboard');
Route::resource('booking', BookingController::class)->middleware(['auth', 'verified', 'customer']);
require __DIR__.'/auth.php';
