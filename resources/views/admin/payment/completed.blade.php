@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Completed Transactions</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Completed Transactions
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer</th>
                        <th>Service Booked</th>
                        <th>Price</th>
                        <th>Staff Assigned</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Date of Billing</th>
                        <th>Date Paid</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer</th>
                        <th>Service Booked</th>
                        <th>Price</th>
                        <th>Staff Assigned</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>                   
                        <th>Date of Billing</th>
                        <th>Date Paid</th>     
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->billing->booking->booking_refnbr }}</td>
                        <td>{{ $payment->billing->booking->customer->name }}</td>
                        <td>{{ $payment->billing->booking->service->service_name }}</td>
                        <td>{{ $payment->billing->booking->service->price }}</td>
                        <td>{{ $payment->billing->booking->staff->name}}</td>
                        <td>{{ $payment->billing->booking->booking_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $payment->billing->booking->booking_schedule->format('Y-m-d h:i A') }}</td>
                        <td>{{ $payment->billing->billing_datetime->format('Y-m-d h:i A') }}</td>
                        <td>{{ $payment->payment_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $payment->billing->booking->transaction_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
