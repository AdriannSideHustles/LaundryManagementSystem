@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Equipments</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-equipment">Add New Equipment</a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listed Equipments
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Image</th>   
                        <th>Equipment Name</th>
                        <th>Description</th>
                        <th>Status Monitoring</th>
                        <th>Last Monitored</th>
                        <th>Monitored by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>   
                        <th>Equipment Name</th>
                        <th>Description</th>
                        <th>Status Monitoring</th>
                        <th>Last Monitored</th>
                        <th>Monitored by</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($equipmentMonitorings as $equipmentMonitoring)
                    <tr>
                        @if($equipmentMonitoring->equipment->img_url != null)
                            <td><img src="{{ Vite::asset('storage/app/public/'. $equipmentMonitoring->equipment->img_url) }}" alt="Equipment Image" width="100"></td>                        
                        @else                        
                            <td><img src="https://via.placeholder.com/150" alt="Equipment Image" width="100"></td>                        
                        @endif                            
                        <td>{{ $equipmentMonitoring->equipment->name }}</td>
                        <td>{{ $equipmentMonitoring->equipment->description }}</td>
                        <td>
                            @if($equipmentMonitoring->equipment_status == "Working")
                                <span style="color: white; background-color: green; padding: 5px 10px; border-radius: 5px;">{{ $equipmentMonitoring->equipment_status }}</span>
                            @else
                                <span style="color: white; background-color: red; padding: 5px 10px; border-radius: 5px;">{{ $equipmentMonitoring->equipment_status }}</span>
                            @endif
                        </td>

                        <td>{{ $equipmentMonitoring->monitoring_date->format('Y-m-d h:i A') }}</td>
                        <td>{{ $equipmentMonitoring->staff->name }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-equipment" data-id="{{ $equipmentMonitoring->equipment->id }}">Edit</a>
                            <form action="{{ route('equipment.destroy', $equipmentMonitoring->equipment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
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
                    <input type="hidden" name="equipment_id" id="equipment_id">
                    <input type="hidden" name="_method" id="method" value="POST">
                    
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Equipment Name" value="" maxlength="255" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Equipment Description" value="" maxlength="255" required="">
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
        $('#create-new-equipment').click(function() {
            $('#productForm').trigger("reset"); 
            $('#ajax-product-modal').modal('show'); 
            $('#productCrudModal').html("Add Equpment");
            $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden'); 
            $('#btn-save').text('Save Equipment'); 
            $('#method').val('POST'); 
            $('#productForm').attr('action', "{{ route('equipment.store') }}"); 
        });

        // Show the modal for editing an existing reward
        $('body').on('click', '.edit-equipment', function() {
            var equipment_id = $(this).data('id');
            $.get("{{ route('equipment.index') }}" + '/' + equipment_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Equipment");
                $('#method').val('PUT'); 
                $('#equipment_id').val(data.id); 
                $('#name').val(data.name); 
                $('#description').val(data.description); 
                if(data.img_url != null){
                $('#hidden_image').val(data.img_url);
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + data.img_url).removeClass('hidden'); 
                }
                else{
                    $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden');
                }
                $('#productForm').attr('action', "{{ route('equipment.update', '') }}/" + data.id); 
                $('#btn-save').text('Update Equipment'); 
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
