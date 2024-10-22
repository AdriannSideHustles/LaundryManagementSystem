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
                        <th>Booking Date</th>
                        <th>Scheduled Date</th>
                        <th>Status</th>
                        <th>Pickup Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Equipment Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($equipments as $equipment)
                    <tr>
                        <td>{{ $equipment -> name }}</td>
                        <td>{{ $equipment -> description }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-booking" data-id="{{ $equipment->id }}">Edit</a>
                            <form action="{{ route('equipment.destroy', $equipment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Equipment Name" value="" maxlength="20" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Equipment Description" value="" maxlength="100" required="">
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
            $('#btn-save').text('Save Equpment'); 
            $('#method').val('POST'); 
            $('#productForm').attr('action', "{{ route('equipment.store') }}"); 
        });

        // Show the modal for editing an existing reward
        $('body').on('click', '.edit-booking', function() {
            var equipment_id = $(this).data('id');
            $.get("{{ route('equipment.index') }}" + '/' + equipment_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Booking");
                $('#method').val('PUT'); 
                $('#equipment_id').val(data.id); 
                $('#name').val(data.name); 
                $('#description').val(data.description); 
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
    });
</script>

@endsection
