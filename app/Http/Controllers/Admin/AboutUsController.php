<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus = AboutUs::all();
        return view('admin.manage-aboutus.index', compact('aboutus'));
    }

    public function create()
    {
        $aboutusTitles = AboutUs::pluck('title', 'id'); // returns ['id' => 'title']
        return view('admin.manage-aboutus.create', compact('aboutusTitles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('aboutus', 'public');
        }

        AboutUs::create($data);
        return redirect()->route('admin.aboutus.index')->with('success', 'About Us entry added!');
    }

    public function destroy($id)
    {
        $item = AboutUs::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Entry deleted successfully');
    }

}
