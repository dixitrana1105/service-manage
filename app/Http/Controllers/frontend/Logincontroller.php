<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\User;
use App\Models\Country;
use App\Models\States;
use App\Models\City;
use App\Models\ThemeSection;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Logincontroller extends Controller
{
    public function login()
    {
        return view('frontend.login-and-register.login');
    }
    public function register()
    {
        return view('frontend.login-and-register.register');
    }
    public function authenticate(Request $request)
    {
        $allowedDomains = ['gmail.com', 'outlook.com', 'hotmail.com']; // List of allowed email domains

        // Custom validation rule for allowed email domains
        Validator::extend('allowed_domain', function ($attribute, $value, $parameters) {
            $emailDomain = substr(strrchr($value, "@"), 1); // Extract domain from email
            return in_array($emailDomain, $parameters); // Check if domain is in allowed list
        });

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'allowed_domain:' . implode(',', $allowedDomains)], // Validate email domain
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Attempt authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

            $user = Auth::user();

            // Check if the user has the role "customer"
            if ($user->role !== 'customer') {
                Auth::logout();
                return redirect()->route('account.login')->with('success', 'Logout successful.');
            }

            // Redirect to intended URL or user profile
            return redirect()->intended(route('home'))->with('success', 'Login successful.');
        } else {
            return redirect()->route('account.login')->withErrors(['error' => 'Either E-mail or Password is incorrect.']);
        }
    }
    public function profile(Request $request)
    {
        $user = Auth::user(); 
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }
    
        $address = CustomerAddress::where('user_id', $user->id)->first();
        $countries = Country::orderBy('name', 'ASC')->get();
        $states = States::orderBy('name', 'ASC')->get();
        $city = City::orderBy('name', 'ASC')->get(); // Renamed to 'cities'
        $companyProfile = CompanyProfile::all();
        $banner = ThemeSection::all(); // example logic
        return view('frontend.profile', compact('user', 'address', 'countries', 'city','states', 'companyProfile', 'banner'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')->with('success', ' You have Successfully logout..! ');
    }
    public function processRegister(Request $request)
    {
        $allowedDomains = ['gmail.com', 'outlook.com', 'hotmail.com']; // List of allowed email domains

        // Custom validation rule for email domain
        Validator::extend('allowed_domain', function ($attribute, $value, $parameters, $validator) {
            $emailDomain = substr(strrchr($value, "@"), 1); // Extract the domain from the email
            return in_array($emailDomain, $parameters); // Check if the domain is in the allowed list
        });

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:6'],
            'email' => [
                'required',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("The email domain must be one of: " . implode(', ', $allowedDomains));
                    }
                }
            ],
            'phone' => ['required', 'digits:10', 'unique:users,phone'], // Ensure phone is unique
            'password' => ['required', 'string', 'min:7', 'confirmed'],
        ]);

        // Check validation failure
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Create and save the user
        if ($validator->passes()) {
            // Create and save the user
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'You have been Successfully Registered!');

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

    }
    public function showChangePasswordForm()
    {
        $companyProfile = CompanyProfile::all();
        return view('frontend.change-password', compact('companyProfile'));
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:10',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {

            $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();

            if (!Hash::check($request->old_password, $user->password)) {

                session()->flash('error', 'Your Old Password is incorrect, Please try again...!');
                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            session()->flash('success', 'Your  Password has been Updated Successfully...!');
            return response()->json([
                'status' => true,
            ]);


        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

}
