@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Services</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-service">Add New Service</a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listed Services
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        @if($service->img_url != null)
                            <td><img src="{{Vite::asset('storage/app/public/' . $service->img_url) }}" alt="Service Image"  width="100"></td>                        
                        @else                        
                            <td><img src="https://via.placeholder.com/150" alt="Service Image"  width="100"></td>                        
                        @endif
                        <td>{{ $service -> service_name }}</td>
                        <td>{{ $service -> description }}</td>
                        <td>{{ $service -> price }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-service" data-id="{{ $service->id }}">Edit</a>
                            <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this Service?');">
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
                    <input type="hidden" name="service_id" id="service_id">
                    <input type="hidden" name="_method" id="method" value="POST">
                    
                    <div class="form-group">
                        <label for="service_name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter Service Name" value="" maxlength="255" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Service Description" value="" maxlength="255" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-4 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Enter Price" value=""  required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Upload Image</label>
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
        $('#create-new-service').click(function() {
            $('#productForm').trigger("reset"); 
            $('#ajax-product-modal').modal('show'); 
            $('#productCrudModal').html("Add Service");
            $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden'); 
            $('#btn-save').text('Save Service'); 
            $('#method').val('POST'); 
            $('#productForm').attr('action', "{{ route('service.store') }}"); 
        });

        // Show the modal for editing an existing reward
        $('body').on('click', '.edit-service', function() {
            var service_id = $(this).data('id');
            $.get("{{ route('service.index') }}" + '/' + service_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Service");
                $('#method').val('PUT'); 
                $('#service_id').val(data.id); 
                $('#service_name').val(data.service_name); 
                $('#description').val(data.description); 
                $('#price').val(data.price); 
                if(data.img_url != null){
                $('#hidden_image').val(data.img_url);
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + data.img_url).removeClass('hidden'); 
                }
                else{
                    $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden');
                }
                $('#productForm').attr('action', "{{ route('service.update', '') }}/" + data.id); 
                $('#btn-save').text('Update Service'); 
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

        // Preview the selected image
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
