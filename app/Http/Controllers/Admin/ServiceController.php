<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // 1. Shows the table of all services
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // 2. Shows the form to create a new service
    public function create()
    {
        return view('admin.services.create');
    }

    // 3. Saves the new service to the database
    public function store(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
        ]);

        // Create the record in the database
        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            // If the checkbox is checked, it returns true. Otherwise, false.
            'is_active' => $request->has('is_active'), 
        ]);

        // Redirect back to the table with a success message
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }
    // 4. Shows the form to edit an existing service
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // 5. Saves the updated service data to the database
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:50',
        ]);

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // 6. Deletes a service from the database
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}