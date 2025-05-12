<?php

namespace App\Http\Controllers;
use App\Models\Broadcast;
use App\Models\CompanyProfile;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function latestBroadcasts()
    {
        $broadcasts = Broadcast::latest()->take(5)->get();
        $companyProfile = CompanyProfile::all();
        return view('frontend.broadcasts.latest', compact('broadcasts', 'companyProfile'));
    }
}
