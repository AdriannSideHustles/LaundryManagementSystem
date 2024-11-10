@extends('layouts.nav')
@section('content')
<div class="container">
    <h1>Select a Service to Book</h1>
    <br>
    <div class="row">
        @foreach ($services as $service)
            <div class="col-lg-3 col-md-6">
                <div class="service-item" style="border: 1px solid #ddd; padding: 15px; text-align: center;">
                    <div class="img-frame" style="width: 100%; height: 200px; overflow: hidden;">
                        <img src="{{ Vite::asset('storage/app/public/'. $service->img_url) }}" alt="Service" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h3>{{ $service->service_name }}</h3>
                    <p>{{ $service->description }}</p>
                    <h5 style="margin-top: -10px; margin-bottom: 10px;">{{ $service->price }}</h5>
                    <a class="btn btn-primary book-now" 
                        data-service-id="{{ $service->id }}"
                        data-service-name="{{ $service->service_name }}" 
                        data-description="{{ $service->description }}" 
                        data-price="{{ $service->price }}">
                        Book this Service
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center my-4"> 
        {{ $services->links('pagination::bootstrap-5') }} 
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <input type="hidden" name="service_id" id="service_id"> <!-- Hidden field for service_id -->
                    
                    <div class="form-group">
                        <label for="service_name" class="col-sm-4 control-label">Service Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="service_name" name="service_name" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-sm-4 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" value="" disabled>
                        </div>
                    </div>                   

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="booking_schedule" class="form-label">Book Schedule</label>
                            <input type="datetime-local" class="form-control" id="booking_schedule" name="booking_schedule" required min="{{ now()->subHours(7)->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" style="margin-top: 10px;">Book Now!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to populate modal with selected service data -->
<script>
    $(document).ready(function() {
        $('.book-now').click(function() {
            var serviceId = $(this).data('service-id');
            var serviceName = $(this).data('service-name');
            var description = $(this).data('description');
            var price = $(this).data('price');

            // Set modal fields
            $('#service_id').val(serviceId); // Hidden field for service ID
            $('#service_name').val(serviceName);
            $('#description').val(description);
            $('#price').val(price);

            // Show the modal
            $('#ajax-product-modal').modal('show');
        });
    });
</script>
@endsection
