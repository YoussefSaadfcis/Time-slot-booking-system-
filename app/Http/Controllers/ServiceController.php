<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {

        $services = Service::all();
        return view("service.welcome", compact('services'));
    }

    public function create()
    {
        return view("service.AddService");
    }
    public  function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'agent_id' => 'required|exists:agents,id',
            'image_path' => 'required|string',
        ]);


        $service = new Service();
        $service->name = $validatedData['name'];
        $service->branch_id = $validatedData['branch_id'];
        $service->agent_id = $validatedData['agent_id'];
        $service->image_path = $validatedData['image_path'];
        $service->save();
        return response()->json(['message' => 'stored sucesfully'], 200);
    }

    public function edit($id)
    {

        $service = Service::findOrFail($id);

        return view("service.UpdateService", compact("service"));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'branch_id' => 'required|exists:branches,id',
            'agent_id' => 'required|exists:agents,id',
            'image_path' => 'required|string',
        ]);

        $service->update($validatedData);
        return redirect()->route('service.index')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service deleted successfully');
    }
}
