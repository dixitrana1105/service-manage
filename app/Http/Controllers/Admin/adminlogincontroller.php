<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                $admin = Auth::guard('admin')->user();
                if ($admin->role == 'Admin') {
                    return redirect()->route('admin.dashboard');
                } else {

                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorize to access Admin Panel');
                }

            } else {
                return redirect()->route('admin.login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('admin.login')
                ->withErrors($validator)->withInput($request->only('email'));
        }
    }

    public function registerUsers(Request $request)
    {
        // Allowed email domains for customers
        $allowedDomains = ['gmail.com', 'outlook.com', 'hotmail.com'];

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:12',
            'role' => 'required|in:customer,Admin',  // Restrict role to "customer" or "Admin"
        ]);

        // If role is "customer", apply domain restriction
        if ($request->role === 'customer') {
            $emailDomain = substr(strrchr($request->email, "@"), 1);
            if (!in_array($emailDomain, $allowedDomains)) {
                return redirect()->back()->with('fail', 'Only Gmail, Outlook, or Hotmail users can register as customers.');
            }
        }

        // Create and save the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password), // Secure password hashing
        ]);

        // Check if the user was created successfully
        if ($user->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'User registered successfully.');
        } else {
            return redirect()->back()->with('fail', 'User registration failed.');
        }
    }


    public function registration()
    {
        return view('admin.registration');
    }
}
