<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class assignedBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['service', 'customer'])->where('staff_user_id', auth()->id())->whereIn('transaction_status', ["Confirmed/Assigned", "Received/In Process"])->orderBy('booking_schedule', 'asc')->get();
        return view('staff.assignedBooking.index', compact('bookings'));
    }

    
    public function getAllBookings()
    {
        $bookings = Booking::with(['service', 'customer'])->where('staff_user_id', auth()->id())->orderBy('booking_schedule', 'asc')->get();
        return view('staff.assignedBooking.trackBookings', compact('bookings'));
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
        //
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
    public function update(Request $request, Booking $booking, $id)
    {
        $request->validate([
            'pickup_schedule' => 'required|date',
        ]);
        $booking = Booking::find($id);
        $booking->update([
            'transaction_status' => "Received/In Process",
            'pickup_schedule' => $request->pickup_schedule,
        ]);

        return response()->json(['success' => 'Laundry Received successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking,$id)
    {
       //
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update([
            'transaction_status' => "Rejected",
        ]);

        return redirect()->route('assignedBooking.index');
        return response()->json(['success' => 'Booking Rejected successfully.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function readyForPickup(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update([
            'transaction_status' => "Ready For Pickup/Payment",
        ]);

        try {
            Billing::create([
                'booking_id' => $id,
                'billing_datetime' => now()->subHours(7),
                'amount' => $booking->service->price,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage()); 
            return response()->json(['message' => 'Failed to create billing: ' . $e->getMessage()], 500);
        }

        return redirect()->route('assignedBooking.index');
        return response()->json(['success' => 'Booking is Now Ready For Pickup']);
    }


}
