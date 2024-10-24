@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Approve/Reject Payments</h1>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Payments
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Booking Ref #</th>
                        <th>Service Booked</th>
                        <th>Amount Payable</th>
                        <th>Billing Date</th>
                        <th>Payment Date</th>
                        <th>Payment Method</th>
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
                        <th>Payment Date</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Staff Assigned</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->billing->booking->booking_refnbr }}</td>
                        <td>{{ $payment->billing->booking->service->service_name }}</td>
                        <td>{{ $payment->billing->booking->service->price }}</td>
                        <td>{{ $payment->billing->billing_datetime }}</td>
                        <td>{{ $payment->payment_date}}</td>
                        <td>{{ $payment->payment_method}}</td>
                        <td>{{ $payment->billing->booking->transaction_status }}</td>
                        <td>{{ $payment->billing->booking->staff->name}}</td>                        
                        <td>
                            @if($payment->payment_method === "GCash")
                            <a href="javascript:void(0)" class="btn btn-primary approve-payment" data-id="{{ $payment->id }}">Approve</a>                            
                            <form action="{{ route('adminPaymentApproval.reject', $payment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Reject Payment?');">
                                @csrf
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
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
                    <input type="hidden" name="payment_id" id="payment_id">
                    <input type="hidden" name="_method" id="method" value="POST">

                    <div class="form-group">
                        <label for="price" class="col-sm-4 control-label">Amount Payable</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" value="" readonly>
                        </div>
                    </div>         
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Proof of Payment</label>
                    </div>
                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="465" height="400" style="margin-top: 10px;">
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

        $('body').on('click', '.approve-payment', function() {
            var payment_id = $(this).data('id');
            $.get("{{ route('adminPaymentApproval.index') }}" + '/' + payment_id + '/edit', function(data) {
                $('#productCrudModal').html("Approve Payment");
                $('#method').val('PUT'); 
                $('#billing_id').val(data.id); 
                $('#price').val(data.price); 
                $('#image_url').val(data.image_url); 
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + data.image_url).removeClass('hidden'); 
                $('#productForm').attr('action', "{{ route('adminPaymentApproval.update', '') }}/" + data.id); 
                $('#btn-save').text('Approve'); 
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
