<?php

namespace App\Http\Controllers;

use App\Models\EquipmentMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentMonitorings =  EquipmentMonitoring::with(['equipment','staff'])->orderBy('created_at', 'desc')->get();    
        return view("staff.equipmentMonitoring.index", compact('equipmentMonitorings'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentMonitoring  $equipmentMonitoring
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentMonitoring $equipmentMonitoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentMonitoring  $equipmentMonitoring
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentMonitoring $equipmentMonitoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EquipmentMonitoring  $equipmentMonitoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentMonitoring $equipmentMonitoring)
    {
        $request->validate([
            'equipment_status' => 'required|string',
        ]);

        // Update the equipment status
        $equipmentMonitoring->equipment_status = $request->equipment_status;
        $equipmentMonitoring->staff_user_id = Auth::id();
        $equipmentMonitoring->monitoring_date = now()->subHours(7);
        $equipmentMonitoring->save();

        return redirect()->route('equipmentMonitoring.index')->with('success', 'Equipment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentMonitoring  $equipmentMonitoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentMonitoring $equipmentMonitoring)
    {
        //
    }
}
