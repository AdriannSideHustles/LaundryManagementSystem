<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['service', 'staff'])->where('customer_user_id', auth()->id())->whereIn('transaction_status', [1,2,3])->orderBy('created_at', 'desc')->get();
        $services = Service::orderBy('service_name', 'asc')->get();
        return view('customer.booking.index', compact('bookings', 'services'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectedCancelledIndex()
    {
        $bookings = Booking::with(['service', 'staff'])->where('customer_user_id', auth()->id())->whereIn('transaction_status', [8, 9])->orderBy('created_at', 'desc')->get();
        return view('customer.booking.cancelledRejected', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_schedule' => 'required|date', 
        ]);
        Booking::create([
            'customer_user_id' => auth()->id(), 
            'staff_user_id' => null,
            'service_id' => $request->input('service_id'),
            'transaction_status' => 1,
            'booking_date' => now()->subHours(7),
            'booking_schedule' => $request->input('booking_schedule'),
            'pickup_schedule' => null,
        ]);

        return response()->json(['success' => 'Booking added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::find($id);
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_schedule' => 'required|date', 
        ]);

        $booking = Booking::find($id);
        $booking->update([
            'service_id' => $request->service_id,
            'booking_schedule' => $request->booking_schedule,
        ]);

        return response()->json(['success' => 'Booking updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully!');
    }
/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update([
            'transaction_status' => 9,
        ]);

        return redirect()->route('booking.index');
        return response()->json(['success' => 'Booking Cancelled successfully.']);
    }
}
