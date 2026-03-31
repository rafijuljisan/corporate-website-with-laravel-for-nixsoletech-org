<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->boolean('is_active');

        Career::create($data);

        return redirect()->route('careers.index')->with('success', 'Job posted successfully!');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index')->with('success', 'Job post removed.');
    }
}