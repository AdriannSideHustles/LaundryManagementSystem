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
                        <th>Current Status</th>
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
                        <th>Current Status</th>
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
                            @if($equipmentMonitoring->equipment_status != "Working")
                                <form action="{{ route('equipmentMonitoring.update', $equipmentMonitoring->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to update the status to Working?');">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="equipment_status" value="Working">
                                    <button type="submit" class="btn btn-primary">Set Status to Working</button>
                                </form>
                            @else
                                <form action="{{ route('equipmentMonitoring.update', $equipmentMonitoring->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to update the status to Needs Repair?');">
                                    @csrf
                                    @method('PUT') 
                                    <input type="hidden" name="equipment_status" value="Needs Repair">
                                    <button type="submit" class="btn btn-danger">Mark as Needs Repair</button>
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
@endsection
