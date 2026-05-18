<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$clientKey    = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');
    }

    // Halaman checkout
    public function show(Booking $booking)
    {
        $booking->load('guest', 'villa');
        

        $params = [
            'transaction_details' => [
                'order_id'     => 'BOOKING-' . $booking->id . '-' . time(),
                'gross_amount' => $booking->total_harga,
            ],
            'customer_details' => [
                'first_name' => $booking->guest->nama,
                'phone'      => $booking->guest->nomor_telpon,
            ],
            'item_details' => [
                [
                    'id'       => 'VILLA-' . $booking->villa->id,
                    'price'    => $booking->total_harga,
                    'quantity' => 1,
                    'name'     => 'Booking Villa ' . $booking->villa->nama,
                ]
            ],
         'enabled_payments' => ['qris', 'bca_va', 'gopay'],
         'qris' => [
        'acquirer' => 'gopay'  
        ],
         'options' => [
        'show_back_button' => true,
    ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.show', compact('booking', 'snapToken'));
    }

    // Webhook dari Midtrans
    public function callback(Request $request)
    {
        $serverKey  = config('services.midtrans.server_key');
        $hashedKey  = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        // Validasi signature biar aman
        if ($hashedKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil booking id dari order_id "BOOKING-{id}-{timestamp}"
        $bookingId = explode('-', $request->order_id)[1];
        $booking   = Booking::findOrFail($bookingId);

        // Tentukan status
        $status = match($request->transaction_status) {
            'capture', 'settlement' => 'paid',
            'pending'               => 'pending',
            default                 => 'cancelled',
        };

        // Simpan ke tabel payments
        Payment::create([
            'booking_id'          => $booking->id,
            'tanggal_pembayaran'  => now(),
            'metode_pembayaran'   => $request->payment_type ?? '-',
            'total_pembayaran'    => $booking->total_harga,
            'status'              => $status,
        ]);

        // Update status booking
        $booking->update(['status' => $status]);

        return response()->json(['message' => 'OK']);
    }

    //  public function success(Request $request)
    // {
    //     $orderId = explode('-', $request->order_id)[1];
    //     $booking = Booking::with('guest', 'villa')->findOrFail($orderId);

    //     if ($booking->status !== 'paid') {
    //         $booking->update(['status' => 'paid']);

    //         Payment::create([
    //             'booking_id'         => $booking->id,
    //             'tanggal_pembayaran' => now(),
    //             'metode_pembayaran'  => $request->payment_type ?? 'midtrans',
    //             'total_pembayaran'   => $booking->total_harga,
    //             'status'             => 'paid',
    //         ]);
    //     }

    //     return view('payment.success', compact('booking'));
    // }

    // public function pending(Request $request)
    // {
    //     $orderId = explode('-', $request->order_id)[1];
    //     $booking = Booking::with('guest', 'villa')->findOrFail($orderId);

    //     if ($booking->status !== 'paid') {
    //         $booking->update(['status' => 'pending']);
    //     }

    //     return view('payment.pending', compact('booking'));
    // }
}