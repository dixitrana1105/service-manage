<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Broadcast;
use App\Jobs\BroadcastMessageJob;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::latest()->get();
        return view('admin.broadcasts.index', compact('broadcasts'));
    }

    public function create()
    {
        return view('admin.broadcasts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'channel' => 'required|in:email,sms,whatsapp'
        ]);

        $broadcast = Broadcast::create([
            'title' => $request->title,
            'message' => $request->message,
            'channel' => $request->channel,
            'user_id' => auth()->id(),
        ]);

        $user = auth()->user(); // get the logged-in user

        dispatch(new BroadcastMessageJob($broadcast, $user));

        return redirect()->route('admin.broadcasts.index')->with('success', 'Broadcast sent.');
    }
    public function edit(Broadcast $broadcast)
    {
        return view('admin.broadcasts.edit', compact('broadcast'));
    }
    public function update(Request $request, Broadcast $broadcast)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'channel' => 'required|in:email,sms,whatsapp',
        ]);

        $broadcast->update([
            'title' => $request->title,
            'message' => $request->message,
            'channel' => $request->channel,
        ]);

        return redirect()->route('admin.broadcasts.index')->with('success', 'Broadcast updated.');
    }
    public function destroy(Broadcast $broadcast)
    {
        $broadcast->delete();
        return redirect()->route('admin.broadcasts.index')->with('success', 'Broadcast deleted.');
    }

}
