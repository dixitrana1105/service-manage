<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDetailSection;
use Illuminate\Http\Request;

class ServiceDetailSectionsController extends Controller
{
    public function index()
    {
        $sections = ServiceDetailSection::with('service')->get();

        return view('admin.service_detail_sections.index', compact('sections'));
    }

    public function create()
    {
        $services = Service::all();

        // Attach existing section IDs
        foreach ($services as $service) {
            $existing = ServiceDetailSection::where('service_id', $service->id)->first();
            $service->existing_section_id = $existing ? $existing->id : null;
        }

        return view('admin.service_detail_sections.create', compact('services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'description_type' => 'required|in:paragraph,bullet,numbered',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/service_details'), $imageName);
            $imagePath = 'uploads/service_details/' . $imageName;
        }

        \App\Models\ServiceDetailSection::create([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description,
            'description_type' => $request->description_type,
            'image' => $imagePath,
            'image_position' => $request->image_position,
        ]);

        return redirect()->route('admin.service-detail-sections.index')->with('success', 'Section created successfully!');
    }

    public function edit($id)
    {
        $section = ServiceDetailSection::findOrFail($id);
        $services = Service::all();
        return view('admin.service_detail_sections.edit', compact('section', 'services'));
    }

    public function update(Request $request, $id)
    {
        $section = ServiceDetailSection::findOrFail($id);

        $request->validate([
            'service_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from correct path
            if ($section->image && file_exists(public_path($section->image))) {
                unlink(public_path($section->image));
            }

            // Store new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/service_details'), $imageName);
            $section->image = 'uploads/service_details/' . $imageName;
        }

        // Only update the fields that should change
        $section->update([
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description, // Update only description
            'description_type' => $request->description_type, // Update description format
            'image_position' => $request->image_position,
        ]);

        return redirect()->route('admin.service-detail-sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy($id)
    {
        $section = ServiceDetailSection::findOrFail($id);

        if ($section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }

        $section->delete();

        return back()->with('success', 'Deleted successfully.');
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $sections = ServiceDetailSection::where('service_id', $service->id)->orderBy('id')->get();

        return view('frontend.service-details', compact('service', 'sections'));
    }

}
