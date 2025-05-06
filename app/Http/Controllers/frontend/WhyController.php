<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhySection;
use App\Models\CompanyProfile;
use App\Models\ThemeSection;

class WhyController extends Controller
{
    public function index()
    {
        $whySections = WhySection::all();
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        $banner = ThemeSection::all(); // example logic
        return view('frontend.why', compact('whySections', 'companyProfile', 'banner'));
    }

}
