<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'color' => 'nullable|string',
        ]);

        // Manual upload to public folder (no storage link needed)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/features'), $imageName);
            $data['image'] = 'uploads/features/' . $imageName;
        }

        Feature::create($data);

        return redirect()->route('admin.features.index')->with('success', 'Feature added successfully.');
    }


    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'color' => 'nullable|string',  // Add validation for color
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/features'), $imageName);
            $data['image'] = 'uploads/features/' . $imageName;
        }

        // Update feature with color
        $feature->update($data);

        return redirect()->route('admin.features.index')->with('success', 'Feature updated successfully.');
    }


    public function destroy(Feature $feature)
    {
        if ($feature->image) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->delete();
        return back()->with('success', 'Feature deleted.');
    }
}
