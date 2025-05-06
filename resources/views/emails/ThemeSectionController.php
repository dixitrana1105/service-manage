<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThemeSection; // Assuming you have a ThemeSection model
use Illuminate\Http\Request;

class ThemeSectionController extends Controller
{
    // Display all theme sections
    public function index()
    {
        $sections = ThemeSection::all();
        return view('admin.theme.index', compact('sections'));
    }

    // Show the form to create a new section
    public function create()
    {
        return view('admin.theme.create');
    }

    // Store new section in the database
    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|unique:theme_sections,section',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/theme'), $filename);
            $imagePath = 'uploads/theme/' . $filename;
        }

        ThemeSection::create([
            'section' => $request->section,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.theme.index')->with('success', 'Theme section created successfully.');
    }

    // Edit an existing section
    public function edit($section)
    {
        $data = ThemeSection::where('section', $section)->firstOrFail();
        return view('admin.theme.edit', compact('data'));
    }

    // Update the theme section
    public function update(Request $request, $section)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = ThemeSection::where('section', $section)->firstOrFail();

        if ($request->hasFile('image')) {
            if ($data->image && file_exists(public_path($data->image))) {
                unlink(public_path($data->image));
            }

            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/theme'), $filename);
            $data->image = 'uploads/theme/' . $filename;
        }

        $data->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $data->image,
        ]);

        return back()->with('success', 'Theme section updated successfully.');
    }

    // Delete a section
    public function destroy($id)
    {
        $section = ThemeSection::findOrFail($id);

        if ($section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }

        $section->delete();

        return redirect()->route('admin.theme.index')->with('success', 'Theme section deleted successfully.');
    }
}
