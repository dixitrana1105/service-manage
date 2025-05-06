<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscribers;
use Illuminate\Support\Facades\Cookie;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;


class SubscribeController extends Controller
{
    public function store(Request $request)
{
    $email = $request->input('email');

    $request->validate([
        'email' => 'required|email|unique:subscribers,email',
    ]);

    // Check if cookie exists
    if (Cookie::has('subscribed_email')) {
        return back()->with('message', 'You have already subscribed.');
    }

    // Save to database
    $subscribe = new Subscribers();
    $subscribe->email = $email;
    $subscribe->save();

    // Send confirmation email (optional)
    Mail::to($email)->send(new SubscriptionConfirmation($subscribe));

    // Set cookie for 30 days
    Cookie::queue('subscribed_email', $email, 60 * 24 * 30); // 30 days validity

    return back()->with('success', 'Thank you for subscribing!');
}

    public function adminIndex()
    {
        $subscribers = Subscribers::latest()->paginate(10);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function unsubscribe(Request $request)
    {
        // Retrieve email from cookie
        $email = Cookie::get('subscribed_email');

        if ($email) {
            // Delete subscriber if found
            $subscriber = Subscribers::where('email', $email)->first();
            if ($subscriber) {
                $subscriber->delete();
            }

            // Forget the cookie
            Cookie::queue(Cookie::forget('subscribed_email'));

            return redirect()->route('home')->with('success', 'You have successfully unsubscribed.');
        }

        return redirect()->route('home')->with('error', 'No subscription found.');
    }


    public function destroy($id)
    {
        $subscriber = Subscribers::findOrFail($id);
        $subscriber->delete();

        // Destroy the cookie
        Cookie::queue(Cookie::forget('subscribed_email'));

        return redirect()->route('admin.subscribers')
            ->with('success', 'Subscriber deleted successfully.');
    }
}
