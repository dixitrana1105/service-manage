<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    // Display the company profile form
    public function index()
    {
        $companyProfile = CompanyProfile::first(); // Retrieve the first profile
        if (!$companyProfile) {
            $companyProfile = new CompanyProfile(); // If not found, create a new empty profile
        }

        return view('admin.company-profile.index', compact('companyProfile'));
    }

    public function update(Request $request)
    {
        // Fetch or create the company profile
        $companyProfile = CompanyProfile::first(); // Adjust according to your logic

        if (!$companyProfile) {
            $companyProfile = new CompanyProfile(); // Create a new instance if none exists
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'company_tagline' => 'nullable|string|max:255',
            'website_url' => 'nullable|url',
            'industry_type' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email_address' => 'nullable|email|max:255',
            'fax_number' => 'nullable|string|max:20',
            'office_address' => 'nullable|string',
            'social_media_links' => 'nullable|string',
        ]);

        // Handle the company logo upload
        
        if ($request->hasFile('company_logo')) {
            // Delete old image
            if ($companyProfile->company_logo && file_exists(public_path($companyProfile->company_logo))) {
                unlink(public_path($companyProfile->company_logo));
            }

            $imageName = time() . '.' . $request->company_logo->extension();
            $request->company_logo->move(public_path('uploads/company_logos'), $imageName);
            $companyProfile->company_logo = 'uploads/company_logos/' . $imageName;
        }


        // Update the rest of the company profile details
        $companyProfile->company_name = $request->company_name;
        $companyProfile->company_tagline = $request->company_tagline;
        $companyProfile->website_url = $request->website_url;
        $companyProfile->industry_type = $request->industry_type;
        $companyProfile->company_description = $request->company_description;
        $companyProfile->phone_number = $request->phone_number;
        $companyProfile->email_address = $request->email_address;
        $companyProfile->fax_number = $request->fax_number;
        $companyProfile->office_address = $request->office_address;
        $companyProfile->social_media_links = $request->social_media_links;

        // Save the updated profile
        $companyProfile->save();

        return redirect()->route('admin.company-profile.index')->with('success', 'Profile updated successfully!');
    }
}
