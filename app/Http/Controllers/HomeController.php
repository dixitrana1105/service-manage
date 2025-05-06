<?php

namespace App\Http\Controllers;
use App\Models\ThemeSection;
use App\Models\CompanyProfile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banner = ThemeSection::all(); // example logic
        // dd('banner');
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        return view('home', compact('banner', 'companyProfile'));
    }

}
