<?php
use App\Http\Controllers\EvStationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\BookingController;


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


// Rout for option
Route::get('/fuel-or-ev', function () {
    return view('option'); // Fuel or EV selection form
})->name('home');



// for run and fatch user/ station data on map
Route::post('/find-stations', [FuelStationController::class, 'findStations'])->name('findStations');

//stations
Route::get('/find-fuel-stations', [FuelStationController::class, 'findStations'])->name('fuel_station.index');
Route::get('/find-ev-stations', [EvStationController::class, 'findStations'])->name('ev_station.index');




use App\Http\Controllers\SlotBookingController;

Route::get('/slot/book/{stationId}', [SlotBookingController::class, 'book'])->name('slot.book');

//book slot and save data on slot or booking table
Route::post('/book', [SlotBookingController::class, 'storeBooking'])->name('booking.store');
Route::get('/booking/details', [SlotBookingController::class, 'bookingDetails'])->name('booking.details');


use App\Http\Controllers\PaymentController;

Route::get('/payment/{id}', [PaymentController::class, 'showPayment'])->name('payment.show');
Route::post('/payment/{id}', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');










require __DIR__.'/auth.php';
