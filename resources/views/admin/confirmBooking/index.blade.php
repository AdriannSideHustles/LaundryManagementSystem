@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Confirm/Assign Bookings</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Pending Bookings
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Customer Name</th>
                        <th>Service Booked</th>
                        <th>Booking Created Date</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_refnbr }}</td>
                        <td>{{ $booking->customer ? $booking->customer->name : 'N/A' }}</td>
                        <td>{{ $booking->service->service_name }}</td>
                        <td>{{ $booking->booking_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->booking_schedule->format('Y-m-d h:i A') }}</td>
                        <td>{{ $booking->transaction_status }}</td>
                        <td>{{ $booking->staff ? $booking->staff->name : 'N/A' }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-booking" data-id="{{ $booking->id }}">Assign</a>
                            <form action="{{ route('confirmBooking.reject', $booking->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to Reject this booking?');">                        
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
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
                        <label for="staff_user_id" class="col-sm-4 control-label">Staff</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="staff_user_id" name="staff_user_id" required="">
                                <option value="">Select a Staff</option>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endforeach
                            </select>
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

        $('body').on('click', '.edit-booking', function() {
            var booking_id = $(this).data('id');
            $.get("{{ route('confirmBooking.index') }}" + '/' + booking_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Booking");
                $('#method').val('PUT'); 
                $('#booking_id').val(data.id); 
                $('#staff_user_id').val(data.staff_user_id); 
                $('#productForm').attr('action', "{{ route('confirmBooking.update', '') }}/" + data.id); 
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
