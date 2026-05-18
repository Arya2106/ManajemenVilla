<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get("/", [LandingController::class, "index"]);

// web.php
Route::get('/booking/pending', [BookingController::class,'pending'])->name('booking.pending');
Route::get('/booking/success', [BookingController::class,'success'])->name('booking.success');
Route::get('/booking/schedule', [BookingController::class, 'schedule'])->name('booking.schedule');
Route::get('/booking/{villa}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('midtrans.callback');
