<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Villa;
use Illuminate\Http\Request;

class LandingController extends Controller
{
public function index()
{
    $villa = Villa::with('villa_photos')->firstOrFail();

    $activeBooking = Booking::where('villa_id', $villa->id)
        ->where('status', 'paid')
        ->where('tanggal_checkin', '<=', now())
        ->where('tanggal_checkout', '>=', now())
        ->first();

    return view('landing', compact('villa', 'activeBooking'));
}

}
