<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['service', 'staff'])->where('customer_user_id', auth()->id())->whereIn('transaction_status', ["Pending","Confirmed/Assigned","Received/In Process"])->orderBy('created_at', 'desc')->get();
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
        $bookings = Booking::with(['service', 'staff'])->where('customer_user_id', auth()->id())->whereIn('transaction_status', ["Rejected", "Cancelled"])->orderBy('created_at', 'desc')->get();
        return view('customer.booking.cancelledRejected', compact('bookings'));
    }
    public function getAllBookings(){
        $bookings = Booking::with(['service', 'staff'])->where('customer_user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('customer.booking.trackBookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::orderBy('service_name', 'asc')->paginate(8);
        return view('customer.booking.create',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate booking schedule
        $request->validate([
            'booking_schedule' => 'required|date',
        ]);

        // Create new booking
        Booking::create([
            'booking_refnbr' => strtoupper(Str::random(3) . rand(10, 99)), // Random booking reference
            'customer_user_id' => auth()->id(), // Authenticated user ID
            'staff_user_id' => null, // Initially null, can be assigned later
            'service_id' => $request->input('service_id'), // Service ID passed from the form
            'transaction_status' => 'Pending', // Default status is pending
            'booking_date' => now()->subHours(7), // Adjusted booking date
            'booking_schedule' => $request->input('booking_schedule'), // Schedule provided by user
            'pickup_schedule' => null, // Pickup schedule can be set later
        ]);

        return redirect()->route('booking.index');
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
        $booking = Booking::with('service')->find($id);
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
            'transaction_status' => "Cancelled",
        ]);

        return redirect()->route('booking.index');
        return response()->json(['success' => 'Booking Cancelled successfully.']);
    }
}
