@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Bookings</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-booking">Book Now!</a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listed Bookings
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Service Booked</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Pickup Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Service Booked</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Pickup Schedule</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->service->service_name }}</td>
                        <td>{{ $booking->booking_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->booking_schedule->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->transaction_status }}</td>
                        <td>{{ $booking->staff ? $booking->staff->name : 'N/A' }}</td>
                        <td>{{ $booking->pickup_schedule ? $booking->pickup_schedule->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-booking" data-id="{{ $booking->id }}">Edit</a>
                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
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
                        <label for="service_id" class="col-sm-4 control-label">Service</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="service_id" name="service_id" required="">
                                <option value="">Select a service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="scheduled_date" class="form-label">Book Schedule</label>
                            <input type="datetime-local" class="form-control" id="booking_schedule" name="booking_schedule" required min="{{ now()->subHours(7)->format('Y-m-d\TH:i') }}">
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
        $('#create-new-booking').click(function() {
            $('#productForm').trigger("reset"); 
            $('#ajax-product-modal').modal('show'); 
            $('#productCrudModal').html("Add Booking");
            $('#btn-save').text('Submit Booking'); 
            $('#method').val('POST'); 
            $('#productForm').attr('action', "{{ route('booking.store') }}"); 
        });

        $('body').on('click', '.edit-booking', function() {
            var booking_id = $(this).data('id');
            $.get("{{ route('booking.index') }}" + '/' + booking_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Booking");
                $('#method').val('PUT'); 
                $('#booking_id').val(data.id); 
                $('#service_id').val(data.service_id); 
                $('#booking_schedule').val(data.booking_schedule); 
                console.log("Booking Schedule: ", data.booking_schedule); 
                $('#productForm').attr('action', "{{ route('booking.update', '') }}/" + data.id); 
                $('#btn-save').text('Save Changes'); 
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
