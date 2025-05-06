<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AboutController extends Controller
{
    public function index()
    {
        $aboutus = Aboutus::all();   
        return view('admin.AboutUs.index', compact('aboutus'));
    }
    public function create()
    {
        $aboutus = \App\Models\AboutUs::first();
        return view('admin.AboutUs.create', compact('aboutus'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        // Store the image and get the path
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/about'), $imageName);
        // Create the new team member
        Aboutus::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('admin.about.index')->with('success', 'About Us Created successfully');
    }
    public function edit($id)
    {
        $aboutus = Aboutus::findOrFail($id);
        return view('admin.AboutUs.edit', compact('aboutus'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $aboutus = Aboutus::findOrFail($id);

        // Update the image if a new one is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($aboutus->image && file_exists(public_path($aboutus->image))) {
                unlink(public_path($aboutus->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/about'), $imageName);
            $aboutus->image = 'uploads/about/' . $imageName;
        }
        // Update other fields
        $aboutus->title = $request->title;
        $aboutus->description = $request->description;

        // Save the changes
        $aboutus->save();

        return redirect()->route('admin.about.index')->with('success', 'About Us updated successfully');
    }
    public function destroy($id)
    {
        $aboutus = Aboutus::findOrFail($id);
        $aboutus->delete();
        return redirect()->route('admin.about.index')->with('success', 'About Us deleted successfully');
    }
}
