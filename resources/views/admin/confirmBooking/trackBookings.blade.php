@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Track Bookings</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of All Bookings
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Amount</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Staff Assigned</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Amount</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Staff Assigned</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_refnbr }}</td>
                        <td>{{ $booking->customer ? $booking->customer->name : 'N/A' }}</td>
                        <td>{{ $booking->service->service_name }}</td>
                        <td>{{ $booking->service->price }}</td>
                        <td>{{ $booking->booking_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->booking_schedule->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->staff ? $booking->staff->name : 'N/A' }}</td>
                        <td>{{ $booking->transaction_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
