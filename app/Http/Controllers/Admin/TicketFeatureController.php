<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappTicketFeature;
use Illuminate\Http\Request;

class TicketFeatureController extends Controller
{
    public function index()
    {
        $features = WhatsappTicketFeature::all();
        return view('admin.ticket.index', compact('features'));
    }
    public function create()
    {
        return view('admin.ticket.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ticket'), $imageName);
            $data['image_url'] = 'uploads/ticket/' . $imageName;
        }

        WhatsappTicketFeature::create($data);

        return redirect()->route('admin.ticket.index')->with('success', 'Feature created successfully.');
    }
    public function edit($id)
    {
        $feature = WhatsappTicketFeature::findOrFail($id);
        return view('admin.ticket.edit', compact('feature'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $feature = WhatsappTicketFeature::findOrFail($id);
        $data = $request->only(['title', 'description']);
    
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/ticket'), $imageName);
            $data['image_url'] = 'uploads/ticket/' . $imageName;
        }
    
        $feature->update($data);
    
        return redirect()->route('admin.ticket.index')->with('success', 'Feature updated successfully.');
    }
    public function destroy($id)
    {
        $feature = WhatsappTicketFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.ticket.index')->with('success', 'Feature deleted.');
    }
    
}
