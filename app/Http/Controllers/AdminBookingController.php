<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['customer','service', 'staff'])->whereIn('transaction_status', ["Pending", "Confirmed/Assigned"])->orderBy('booking_schedule', 'asc')->get();
        $staffs = User::where('role', 'Staff')->orderBy('name', 'asc')->get();
        return view('admin.confirmBooking.index', compact('bookings', 'staffs'));
    }
    public function rejectedCancelledIndex()
    {
        $bookings = Booking::with(['customer','service', 'staff'])->whereIn('transaction_status', ["Rejected", "Cancelled"])->orderBy('created_at', 'desc')->get();
        return view('admin.confirmBooking.cancelledRejected', compact('bookings'));
    }
    public function getAllBookings()
    {
        $bookings = Booking::with(['customer','service', 'staff'])->get();
        return view('admin.confirmBooking.trackBookings', compact('bookings'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_user_id' => 'required|exists:users,id',
        ]);
        $booking = Booking::find($id);
        $booking->update([
            'transaction_status' => "Confirmed/Assigned",
            'staff_user_id' => $request->staff_user_id,
        ]);

        return response()->json(['success' => 'Booking Cofirmed successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
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

        return redirect()->route('confirmBooking.index');
        return response()->json(['success' => 'Booking Rejected successfully.']);
    }

}
