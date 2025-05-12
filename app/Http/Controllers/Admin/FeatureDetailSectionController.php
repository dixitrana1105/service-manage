<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureDetailSection;
use Illuminate\Http\Request;

class FeatureDetailSectionController extends Controller
{
    public function index()
    {
        $sections = FeatureDetailSection::with('feature')->latest()->get();
        return view('admin.feature_detail_sections.index', compact('sections'));
    }

    public function create()
    {
        $features = Feature::all();
        return view('admin.feature_detail_sections.create', compact('features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'feature_id' => 'required|exists:features,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'description_type' => 'required|in:paragraph,bullet,numbered',
            'image_position' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/feature-details'), $filename);

        FeatureDetailSection::create([
            'feature_id' => $request->feature_id,
            'title' => $request->title,
            'description' => $request->description,
            'description_type' => $request->description_type,
            'image_position' => $request->image_position,
            'image' => 'uploads/feature-details/' . $filename,
        ]);

        return redirect()->route('admin.feature-detail-sections.index')->with('success', 'Feature detail section created.');
    }


    public function edit($id)
    {
        $section = FeatureDetailSection::findOrFail($id);
        $features = Feature::all();
        return view('admin.feature_detail_sections.edit', compact('section', 'features'));
    }

    public function update(Request $request, $id)
    {
        $section = FeatureDetailSection::findOrFail($id);

        $request->validate([
            'feature_id' => 'required|exists:features,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'description_type' => 'required|in:paragraph,bullet,numbered',
            'image_position' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only([
            'feature_id',
            'title',
            'description',
            'description_type',
            'image_position'
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/feature-details'), $filename);
            $data['image'] = 'uploads/feature-details/' . $filename;

            // Optionally delete old image
            $oldImagePath = public_path($section->image);
            if (file_exists($oldImagePath)) {
                @unlink($oldImagePath);
            }
        }

        $section->update($data);

        return redirect()->route('feature-detail-sections.index')->with('success', 'Feature detail section updated.');
    }


    public function destroy($id)
    {
        $section = FeatureDetailSection::findOrFail($id);

        // Delete the associated image if it exists
        if ($section->image && \Storage::disk('public')->exists($section->image)) {
            \Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->back()->with('success', 'Deleted successfully.');
    }
}
