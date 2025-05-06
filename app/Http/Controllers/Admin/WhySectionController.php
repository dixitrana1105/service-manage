<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhySection;
use Illuminate\Http\Request;

class WhySectionController extends Controller
{
    public function index()
    {
        $whySections = WhySection::all();
        return view('admin.why.index', compact('whySections'));
    }

    public function create()
    {
        return view('admin.why.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload manually
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/why_images'), $imageName);

        WhySection::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'uploads/why_images/' . $imageName,
        ]);

        return redirect()->route('admin.why.index')->with('success', 'Section added successfully');
    }

    public function edit($id)
    {
        $whySection = WhySection::findOrFail($id);
        return view('admin.why.edit', compact('whySection'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $whySection = WhySection::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path($whySection->image))) {
                unlink(public_path($whySection->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/why_images'), $imageName);
            $whySection->image = 'uploads/why_images/' . $imageName;
        }

        $whySection->title = $request->title;
        $whySection->description = $request->description;
        $whySection->save();

        return redirect()->route('admin.why.index')->with('success', 'Section updated successfully');
    }

    public function destroy($id)
    {
        $whySection = WhySection::findOrFail($id);

        // Delete image from public folder
        if ($whySection->image && file_exists(public_path($whySection->image))) {
            unlink(public_path($whySection->image));
        }

        $whySection->delete();

        return redirect()->route('admin.why.index')->with('success', 'Section deleted successfully');
    }
}
