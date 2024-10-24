@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Assigned Bookings</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Assigned Bookings
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Price</th>
                        <th>Scheduled Date/Time</th>
                        <th>Status</th>
                        <th>Estimated Pickup Sched</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Price</th>
                        <th>Scheduled Date/Time</th>
                        <th>Status</th>
                        <th>Estimated Pickup Sched</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_refnbr }}</td>
                        <td>{{ $booking->customer->name }}</td>
                        <td>{{ $booking->service->service_name }}</td>
                        <td>{{ $booking->service->price }}</td>
                        <td>{{ $booking->booking_schedule->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->transaction_status }}</td>
                        <td>{{ $booking->pickup_schedule ? $booking->pickup_schedule->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>
                            @if($booking->transaction_status === "Confirmed/Assigned")
                            <a href="javascript:void(0)" class="btn btn-primary receive-booking" data-id="{{ $booking->id }}">Received</a>
                            <form action="{{ route('assignedBooking.reject', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to Reject this booking?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                            @else
                            <form action="{{ route('assignedBooking.readyForPickup', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ready for Pickup?');">
                                @csrf
                                <button type="submit" class="btn btn-success">Ready For Pickup</button>
                            </form>
                            @endif                                                       
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="booking_id" id="booking_id">
                    <input type="hidden" name="_method" id="method" value="POST">
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="pickup_schedule" class="form-label">Estimated Pickup Schedule</label>
                            <input type="datetime-local" class="form-control" id="pickup_schedule" name="pickup_schedule" required min="{{ now()->subHours(7)->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" style="margin-top: 10px;"></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show the modal for adding new reward
        // $('#create-new-booking').click(function() {
        //     $('#productForm').trigger("reset"); 
        //     $('#ajax-product-modal').modal('show'); 
        //     $('#productCrudModal').html("Add Booking");
        //     $('#btn-save').text('Submit Booking'); 
        //     $('#method').val('POST'); 
        //     $('#productForm').attr('action', "{{ route('booking.store') }}"); 
        // });

        $('body').on('click', '.receive-booking', function() {
            var booking_id = $(this).data('id');
            $.get("{{ route('assignedBooking.index') }}" + '/' + booking_id + '/edit', function(data) {
                $('#productCrudModal').html("Receive Laundry");
                $('#method').val('PUT'); 
                $('#booking_id').val(data.id); 
                $('#pickup_schedule').val(data.pickup_schedule);  
                $('#productForm').attr('action', "{{ route('assignedBooking.update', '') }}/" + data.id); 
                $('#btn-save').text('Confirm'); 
                $('#ajax-product-modal').modal('show'); 
            });
        });

   

        // Handle form submission
        $('#productForm').on('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(this); 

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    $('#ajax-product-modal').modal('hide');
                    location.reload(); 
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>

@endsection
