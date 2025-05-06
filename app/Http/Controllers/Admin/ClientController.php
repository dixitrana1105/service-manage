<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'testimonial' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  // Get the file extension
            $request->image->move(public_path('uploads/clients'), $imageName);  // Move the file to the 'uploads/clients' folder
        }

        // Create new client record
        Client::create([
            'name' => $request->name,
            'position' => $request->position,
            'testimonial' => $request->testimonial,
            'image' => 'uploads/clients/' . $imageName,  // Store the image path in the database
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client added successfully!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'testimonial' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $client = Client::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/clients'), $imageName);
            $client->image = 'uploads/clients/' . $imageName; // Update the image path in the database
        }

        $client->update([
            'name' => $request->name,
            'position' => $request->position,
            'testimonial' => $request->testimonial,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        // Optionally, delete the client's image if needed
        if ($client->image && file_exists(public_path($client->image))) {
            unlink(public_path($client->image));
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully!');
    }
}
