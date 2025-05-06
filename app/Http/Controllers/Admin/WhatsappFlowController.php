<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappFlow;
use Illuminate\Http\Request;

class WhatsappFlowController extends Controller
{
    public function edit()
    {
        $flow = WhatsappFlow::first();
        return view('admin.whatsapp-flow.edit', compact('flow'));
    }

    public function update(Request $request)
    {
        $data = WhatsappFlow::first() ?? new WhatsappFlow();

        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'features' => 'nullable|array',
            'features.*.icon' => 'required|string',
            'features.*.name' => 'required|string|max:255',
            'features.*.description' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/whatsapp-flows'), $imageName);

            // Delete old image
            if ($data->image && file_exists(public_path('uploads/whatsapp-flows/' . $data->image))) {
                unlink(public_path('uploads/whatsapp-flows/' . $data->image));
            }

            $data->image = $imageName;
        }

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->features = $request->features ? json_encode($request->features) : null;
        $data->save();

        return redirect()->back()->with('success', 'WhatsApp Flow updated successfully!');
    }
}
