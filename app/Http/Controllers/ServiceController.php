<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get(); 
        return view("admin.service.index", compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'service_name' => 'required|max:50',
            'description' => 'required|max:100',
            'price' => 'required|numeric',
        ]);

        $service = new Service();
        $service->service_name = $request->input('service_name');
        $service->description = $request->input('description');
        $service->price = $request->input('price');

        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
            
            $imagePath = $image_url->storeAs('services', $imageName, 'public');
            $service->img_url = $imagePath;
        }

        $service->save();

        return response()->json(['success' => 'Service added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);

        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|max:50',
            'description' => 'required|max:100',
            'price' => 'required|numeric',
        ]);

        $service = Service::find($id);

        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->price = $request->price;

        if ($request->hasFile('image_url')) {
            // Store the new image
            $path = $request->file('image_url')->store('services', 'public');
    
            // Delete the old image if it exists
            if ($service->img_url && Storage::disk('public')->exists($service->img_url)) {
                Storage::disk('public')->delete($service->img_url);
            }
    
            // Update the image_url with the new path
            $service->img_url = $path;
        }
        $service->save();

        return response()->json(['success' => 'Service updated successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        if ($service->img_url && Storage::disk('public')->exists($service->img_url)) {
            Storage::disk('public')->delete($service->img_url);
        }
    
        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service deleted successfully!');
    }
}
