<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppPreview;
use Illuminate\Http\Request;

class WhatsAppPreviewController extends Controller
{
    public function index()
    {
        $preview = WhatsAppPreview::first();
        return view('admin.whatsapp-preview.edit', compact('preview'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'header_text' => 'required',
            'icon_image' => 'nullable|image',
            'chat_messages' => 'required|array',
            'chat_messages.*.type' => 'required|in:user,bot',
            'chat_messages.*.message' => 'required|string',
            'video' => 'nullable|file|mimes:mp4',
        ]);

        $preview = WhatsAppPreview::firstOrNew([]);

        if ($request->hasFile('icon_image')) {
            $icon = $request->file('icon_image');
            $iconName = time() . '_icon.' . $icon->getClientOriginalExtension();
            $icon->move(public_path('uploads'), $iconName);
            $preview->icon_image = 'uploads/' . $iconName;
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '_video.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads'), $videoName);
            $preview->video = 'uploads/' . $videoName;
        }

        $preview->title = $request->title;
        $preview->header_text = $request->header_text;
        $preview->chat_messages = array_values($request->chat_messages); // Reindex to ensure saving properly

        $preview->save();

        return redirect()->back()->with('success', 'Preview updated successfully.');
    }
}
