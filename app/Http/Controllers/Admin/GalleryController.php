<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->boolean('is_active');
        $data['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::create($data);

        return redirect()->route('galleries.index')->with('success', 'Image added to gallery!');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image from storage
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Image removed from gallery.');
    }
}