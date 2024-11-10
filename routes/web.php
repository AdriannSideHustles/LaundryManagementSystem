<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AssignedBookingController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentMonitoringController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffPaymentController;
use App\Http\Controllers\UserController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login'); 
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register'); 
    })->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin/dashboard',[HomeController::class,'admin']) -> middleware(['auth','verified','admin']);
Route::get('admin/staffRecords/index', [HomeController::class, 'getAllStaffs']);
Route::get('admin/staffRecords/{id}', [HomeController::class, 'staffRecords'])->name('staff.records');
Route::resource('service', ServiceController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('equipment', EquipmentController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('confirmBooking', AdminBookingController::class)->middleware(['auth', 'verified', 'admin']);
Route::post('/confirmBooking/{id}', [AdminBookingController::class, 'reject'])->name('confirmBooking.reject');
// Route::resource('adminPaymentApproval', AdminPaymentController::class)->middleware(['auth', 'verified', 'admin']);
Route::post('/rejectPayment/{id}', [AdminPaymentController::class, 'reject'])->name('adminPaymentApproval.reject');
Route::get('admin/payment/completed', [AdminPaymentController::class, 'completedTransactions']);
Route::get('admin/confirmBooking/cancelledRejected', [AdminBookingController::class, 'rejectedCancelledIndex']);
Route::get('admin/confirmBooking/trackBookings', [AdminBookingController::class, 'getAllBookings']);




Route::get('staff/dashboard',[HomeController::class,'staff']) -> middleware(['auth','verified','staff']);
Route::resource('assignedBooking', assignedBookingController::class)->middleware(['auth', 'verified', 'staff']);
Route::post('/rejectBooking/{id}', [assignedBookingController::class, 'reject'])->name('assignedBooking.reject');
Route::post('/doneLaundry/{id}', [assignedBookingController::class, 'readyForPickup'])->name('assignedBooking.readyForPickup');
Route::resource('staffPaymentApproval', StaffPaymentController::class)->middleware(['auth', 'verified', 'staff']);
Route::post('/rejectPayment/{id}', [StaffPaymentController::class, 'reject'])->name('staffPaymentApproval.reject');
Route::get('staff/payment/completed', [StaffPaymentController::class, 'completedTransactions']);
Route::get('staff/assignedBooking/trackBookings', [assignedBookingController::class, 'getAllBookings']);
Route::resource('equipmentMonitoring', EquipmentMonitoringController::class)->middleware(['auth', 'verified', 'staff']);


Route::get('customer/dashboard',[HomeController::class,'customer']) -> middleware(['auth','verified','customer']);
Route::resource('booking', BookingController::class)->middleware(['auth', 'verified', 'customer']);
Route::get('customer/booking/cancelledRejected', [BookingController::class, 'rejectedCancelledIndex']);
Route::post('/cancelBooking/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::resource('billing', BillingController::class)->middleware(['auth', 'verified', 'customer']);
Route::resource('payment', PaymentController::class)->middleware(['auth', 'verified', 'customer']);
Route::get('customer/booking/trackBookings', [BookingController::class, 'getAllBookings']);


require __DIR__.'/auth.php';
