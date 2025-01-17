<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Service::query();

    // Perform a search if the search term is provided
    if ($request->has('search') && $request->search) {
        $query->where('service_name', 'like', '%' . $request->get('search') . '%')
              ->orWhere('status', 'like', '%' . $request->get('search') . '%'); // Searching both columns
    }

    // Order by status and paginate
    $services = $query->orderBy('status', 'desc')->paginate(10); // Paginate results

    return view('services.index', ['services' => $services]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('services.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:150',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:30'
        ]);

        $service = Service::create($data);

        return redirect()->route('services.show', $service)->with('success', 'Service created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:150',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:30'
        ]);

        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if($service->delete()) {
            return redirect()->route('services.index')->with('success', 'Service deleted.');
        }
    }
}
