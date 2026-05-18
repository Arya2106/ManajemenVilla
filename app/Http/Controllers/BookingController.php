<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Villa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create (Villa $villa)
    {
        $villa->load('villa_photos');

        $bookedDates = Booking::where('villa_id', $villa->id)
        ->where('status', 'paid')
        ->where('tanggal_checkout', '>=', now())
        ->get(['tanggal_checkin', 'tanggal_checkout'])
        ->map(function ($booking) {
            return [
                'checkin'  => $booking->tanggal_checkin->format('Y-m-d'),
                'checkout' => $booking->tanggal_checkout->format('Y-m-d'),
            ];
        });

        return view('booking.create', compact('villa', 'bookedDates'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'villa_id' => 'required|exists:villas,id',
            'nama' => 'required',
            'nomor_telpon' => 'required',
            'nomor_ktp' => 'required',
            'tanggal_checkin' => 'required',
            'tanggal_checkout' => 'required',
            'jumlah_tamu' => 'required',
            'catatan' => 'nullable',
            'foto_ktp' => 'nullable',
        ]);

        $guest = Guest::create([
            'nama'=> $request->nama,
            'nomor_telpon'=> $request->nomor_telpon,
            'nomor_ktp'=> $request->nomor_ktp,
            'foto_ktp' => $request->foto_ktp ?? '-',
        ]);

        $villa = Villa::findOrFail($request->villa_id);
        $malam = Carbon::parse($request->tanggal_checkin)
                        ->diffInDays($request->tanggal_checkout);
        $total = $malam * $villa->harga_permalam;

        $booking = Booking::create([
            'villa_id' => $villa->id,
            'guest_id' => $guest->id,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'jumlah_tamu' => $request->jumlah_tamu,
            'catatan' => $request->catatan,
            'total_harga' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('payment.show', $booking->id);
    }

   public function success(Request $request)
{
    $orderId = explode('-', $request->order_id)[1];
    $booking = Booking::with('guest', 'villa')->findOrFail($orderId);

    return view('payment.success', compact('booking'));
}

public function pending(Request $request)
{
    $orderId = explode('-', $request->order_id)[1];
    $booking = Booking::with('guest', 'villa')->findOrFail($orderId);

    return view('payment.pending', compact('booking'));
}

public function receipt(Booking $booking)
{
    $booking->load('guest', 'villa', 'payments');
    
    // Only allow printing receipt if paid
    if ($booking->status !== 'paid') {
        return redirect()->route('booking.schedule')->with('error', 'Booking belum dibayar.');
    }

    return view('payment.receipt', compact('booking'));
}

public function schedule ()
{
    $villa = Villa::with('villa_photos')->firstOrFail();
    $bookings = Booking::with('guest')->get();

    return view ('booking.schedule', compact('villa', 'bookings'));
}


}
