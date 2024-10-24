@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Billings</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Billings
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Service Booked</th>
                        <th>Amount Payable</th>
                        <th>Billing Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Service Booked</th>
                        <th>Amount Payable</th>
                        <th>Billing Date</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($billings as $billing)
                    <tr>
                        <td>{{ $billing->booking->booking_refnbr }}</td>
                        <td>{{ $billing->booking->service->service_name }}</td>
                        <td>{{ $billing->booking->service->price }}</td>
                        <td>{{ $billing->billing_datetime }}</td>
                        <td>{{ $billing->booking->transaction_status }}</td>
                        <td>{{ $billing->booking->staff->name}}</td>                        
                        <td>
                            @if($billing->booking->transaction_status === "Ready For Pickup/Payment")
                            <a href="javascript:void(0)" class="btn btn-primary pay-billing" data-id="{{ $billing->id }}">Pickup/Pay</a>                            
                            @else
                            <button type="#" class="btn btn-secondary" disabled>Not Applicable</button>                            
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
                    <input type="hidden" name="billing_id" id="billing_id">
                    <input type="hidden" name="_method" id="method" value="POST">

                    <div class="form-group">
                        <label for="payment_method" class="col-sm-4 control-label">Payment Method</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="payment_method" name="payment_method" required="">
                                <option value="">Select Payment Method</option>
                                <option value="Cash">Spot Cash</option>
                                <option value="GCash">Gcash Payment</option>
                            </select>
                        </div>
                    </div>                  
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Upload Receipt Image (Proof of Payment)</label>
                        <div class="col-sm-12">
                            <input id="image_url" type="file" name="image_url" accept="image/*" onchange="readURL(this);" >
                            <input type="hidden" name="hidden_image" id="hidden_image" >
                        </div>
                    </div>
                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100" style="margin-top: 10px;">                    
                    
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

        $('body').on('click', '.pay-billing', function() {
            var billing_id = $(this).data('id');
            $.get("{{ route('billing.index') }}" + '/' + billing_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Billing");
                $('#method').val('PUT'); 
                $('#billing_id').val(data.id); 
                $('#payment_method').val(data.payment_method); 
                $('#image_url').val(data.image_url); 
                $('#productForm').attr('action', "{{ route('billing.update', '') }}/" + data.id); 
                $('#btn-save').text('Complete Payment'); 
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#modal-preview').attr('src', e.target.result).removeClass('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#image_url').change(function() {
            readURL(this); 
        });
    });
</script>

@endsection
