<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('search') && $request->search) {
            $query->where('service_name', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%');
        }

        $services = $query->orderBy('status', 'desc')->paginate(10);

        return view('services.index', ['services' => $services]);
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:150',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:30',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'device_id' => 'required|exists:devices,id',
        ]);

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service added successfully!');
    }

    public function show(Service $service)
    {
        //
    }

    public function edit(Service $service)
    {
        //
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:150',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:30',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $service->update($data);

        return redirect()->route('services.index', $service)->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
