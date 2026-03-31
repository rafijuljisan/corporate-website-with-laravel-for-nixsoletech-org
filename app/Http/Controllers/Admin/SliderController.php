<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // ── 1. List all sliders ──────────────────────────────
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    // ── 2. Show create form ──────────────────────────────
    public function create()
    {
        return view('admin.sliders.create');
    }

    // ── 3. Store new slider ──────────────────────────────
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'description'     => 'nullable|string|max:600',
            'image'           => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'button_text'     => 'nullable|string|max:80',
            'button_url'      => 'nullable|string|max:255',
            'button_text_2'   => 'nullable|string|max:80',
            'button_url_2'    => 'nullable|string|max:255',
            'badge_label'     => 'nullable|string|max:60',
            'overlay_color'   => 'nullable|string|max:7',
            'overlay_opacity' => 'nullable|integer|min:0|max:100',
            'order'           => 'nullable|integer|min:0',
        ]);

        // Store image in storage/app/public/sliders/
        $data['image_path']    = $request->file('image')->store('sliders', 'public');
        $data['is_active']     = $request->boolean('is_active', true);
        $data['overlay_color'] = $data['overlay_color'] ?? '#000000';
        $data['overlay_opacity'] = $data['overlay_opacity'] ?? 50;
        $data['order']         = $data['order'] ?? 0;

        unset($data['image']); // remove the raw file — we keep image_path

        Slider::create($data);

        return redirect()->route('sliders.index')
                         ->with('success', 'Slider created successfully.');
    }

    // ── 4. Show edit form ────────────────────────────────
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    // ── 5. Update slider ─────────────────────────────────
    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'           => 'required|string|max:255',
            'subtitle'        => 'nullable|string|max:255',
            'description'     => 'nullable|string|max:600',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'button_text'     => 'nullable|string|max:80',
            'button_url'      => 'nullable|string|max:255',
            'button_text_2'   => 'nullable|string|max:80',
            'button_url_2'    => 'nullable|string|max:255',
            'badge_label'     => 'nullable|string|max:60',
            'overlay_color'   => 'nullable|string|max:7',
            'overlay_opacity' => 'nullable|integer|min:0|max:100',
            'order'           => 'nullable|integer|min:0',
        ]);

        // Replace image only if a new one was uploaded
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image_path); // remove old file
            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }

        $data['is_active']      = $request->boolean('is_active', true);
        $data['overlay_color']  = $data['overlay_color']  ?? '#000000';
        $data['overlay_opacity']= $data['overlay_opacity'] ?? 50;
        $data['order']          = $data['order'] ?? $slider->order;

        unset($data['image']);

        $slider->update($data);

        return redirect()->route('sliders.index')
                         ->with('success', 'Slider updated successfully.');
    }

    // ── 6. Delete slider ─────────────────────────────────
    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image_path);
        $slider->delete();

        return redirect()->route('sliders.index')
                         ->with('success', 'Slider deleted successfully.');
    }
}