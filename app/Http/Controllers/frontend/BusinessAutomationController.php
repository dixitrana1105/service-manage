<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\BusinessAutomation;  // Assuming you have a BusinessAutomation model
use App\Models\ThemeSection;
use Illuminate\Http\Request;

class BusinessAutomationController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        $data = BusinessAutomation::first(); // This fetches the dynamic data
        $banner = ThemeSection::all(); // example logic
        return view('frontend.business-automation', compact('companyProfile', 'data', 'banner'));
    }
}
