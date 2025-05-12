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
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,wmv|max:10240' // max 10MB
        ]);

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Get MIME type before moving
            $mime = $file->getMimeType();

            if (str_starts_with($mime, 'video')) {
                $mediaType = 'video';
            } elseif (str_starts_with($mime, 'image')) {
                $mediaType = 'image';
            }

            // Generate unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move file to public/uploads/theme/
            $file->move(public_path('uploads/theme'), $filename);

            // Save the path for DB
            $mediaPath = 'uploads/theme/' . $filename;
        }

        // Save to database
        $themeSection = new ThemeSection();
        $themeSection->section = $request->section;
        $themeSection->title = $request->title;
        $themeSection->subtitle = $request->subtitle;
        $themeSection->image = $mediaPath;
        $themeSection->media_type = $mediaType;
        $themeSection->save();

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
            'image' => 'nullable|file|mimetypes:image/jpeg,image/png,image/jpg,video/mp4,video/avi,video/quicktime|max:51200', // 50MB max
        ], [
            'image.max' => 'The uploaded file must not be greater than 50MB.',
            'image.mimetypes' => 'Only JPG, PNG images or MP4/AVI/MOV videos are allowed.',
        ]);

        $data = ThemeSection::where('section', $section)->firstOrFail();

        if ($request->hasFile('image')) {
            // Remove previous media file
            if ($data->image && file_exists(public_path($data->image))) {
                unlink(public_path($data->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/theme/media'), $filename);

            $mediaPath = 'uploads/theme/media/' . $filename;
            $extension = strtolower($file->getClientOriginalExtension());

            $data->image = $mediaPath;
            $data->media_type = in_array($extension, ['mp4', 'avi', 'mov', 'wmv']) ? 'video' : 'image';
        }

        // Update other fields
        $data->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $data->image,
            'media_type' => $data->media_type,
        ]);
        $data->save();



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
