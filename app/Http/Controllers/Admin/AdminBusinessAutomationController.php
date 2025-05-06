<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessAutomation; // Assuming you have a BusinessAutomation model
use Illuminate\Http\Request;

class AdminBusinessAutomationController extends Controller
{
    public function index()
    {
        $data = BusinessAutomation::first();
        return view('admin.business-automation.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'benefits' => 'required|array',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->move(public_path('uploads'), $request->file('image')->getClientOriginalName());
        }

        BusinessAutomation::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path ? 'uploads/' . basename($path) : null,
                'benefits' => $request->benefits,
            ]
        );

        return back()->with('success', 'Business Automation content updated successfully!');
    }
}
