<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentMonitorings =  EquipmentMonitoring::with(['equipment','staff'])->orderBy('created_at', 'desc')->get();    
        return view("admin.equipment.index", compact('equipmentMonitorings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:100',
        ]);

        $equipment = new Equipment();
        $equipment->name = $request->input('name');
        $equipment->description = $request->input('description');

        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
            
            $imagePath = $image_url->storeAs('equipments', $imageName, 'public');
            $equipment->img_url = $imagePath;
        }
        $equipment->save();

        $equipmentMonitoring = new EquipmentMonitoring();
        $equipmentMonitoring->staff_user_id = Auth::id();
        $equipmentMonitoring->equipment_id = $equipment->id;
        $equipmentMonitoring->monitoring_date = now()->subHours(7);
        $equipmentMonitoring->equipment_status = "Working";
        $equipmentMonitoring->save();

        return response()->json(['success' => 'Equipment added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::find($id);

        return response()->json($equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:20',
            'description' => 'required|max:100',
        ]);

        $equipment = Equipment::find($id);
        $equipment->name = $request->name;
        $equipment->description = $request->description;

        if ($request->hasFile('image_url')) {
            // Store the new image
            $path = $request->file('image_url')->store('equipments', 'public');
    
            // Delete the old image if it exists
            if ($equipment->img_url && Storage::disk('public')->exists($equipment->img_url)) {
                Storage::disk('public')->delete($equipment->img_url);
            }
    
            // Update the image_url with the new path
            $equipment->img_url = $path;
        }
        $equipment->save();

        return response()->json(['success' => 'Equipment updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipmentMonitoring = EquipmentMonitoring::where('equipment_id', $equipment->id)->first();
        $equipmentMonitoring->delete(); 
        if ($equipment->img_url && Storage::disk('public')->exists($equipment->img_url)) {
            Storage::disk('public')->delete($equipment->img_url);
        }
    
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}
