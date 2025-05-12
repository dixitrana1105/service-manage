<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppChatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminWhatsAppChatbotController extends Controller
{
    public function index()
{
    $data = WhatsAppChatbot::first(); // This returns a single object, not a collection
    return view('admin.whatsapp.index', compact('data'));
}                 

    public function create()
    {
        return view('admin.whatsapp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'feature_titles' => 'required|array',
            'feature_icons' => 'required|array',
            'feature_descriptions' => 'required|array',
        ]);
    
        $chatbot = WhatsAppChatbot::first();
    
        if ($request->hasFile('image')) {
            if (!empty($chatbot->image) && File::exists(public_path($chatbot->image))) {
                File::delete(public_path($chatbot->image));
            }
    
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $imagePath = 'uploads/' . $imageName;
        } else {
            $imagePath = $chatbot->image ?? null;
        }
    
        WhatsAppChatbot::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'feature_titles' => $request->feature_titles,
                'feature_icons' => $request->feature_icons,
                'feature_descriptions' => $request->feature_descriptions,
            ]
        );
    
        return back()->with('success', 'WhatsApp Chatbot updated successfully!');
    }
    

    public function edit($id)
    {
        $data = WhatsAppChatbot::findOrFail($id);
        return view('admin.whatsapp.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $chatbot = WhatsAppChatbot::findOrFail($id);
        $imagePath = $chatbot->image;

        if ($request->hasFile('image')) {
            if ($chatbot->image && File::exists(public_path($chatbot->image))) {
                File::delete(public_path($chatbot->image));
            }

            $uploadedImage = $request->file('image');
            $imageName = time() . '_' . $uploadedImage->getClientOriginalName();
            $uploadedImage->move(public_path('uploads'), $imageName);
            $imagePath = 'uploads/' . $imageName;
        }

        $chatbot->update([
            'title' => $request->title,
            'description' => $request->description,
            'features' => $request->features,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.whatsapp.index')->with('success', 'Chatbot updated successfully!');
    }

    public function destroy($id)
    {
        $chatbot = WhatsAppChatbot::findOrFail($id);

        if ($chatbot->image && File::exists(public_path($chatbot->image))) {
            File::delete(public_path($chatbot->image));
        }

        $chatbot->delete();

        return redirect()->route('admin.whatsapp.index')->with('success', 'Chatbot deleted successfully!');
    }

}
