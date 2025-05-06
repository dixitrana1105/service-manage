<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\ThemeSection;
use App\Models\CompanyProfile;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        $banner = ThemeSection::all(); // example logic
        return view('frontend.team', compact('teams', 'companyProfile', 'banner'));
    }

}
