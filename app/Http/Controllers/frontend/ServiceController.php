<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\ThemeSection;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        $banner = ThemeSection::all(); // example logic
        return view('frontend.service', compact('companyProfile', 'banner'));
        
    }

}
