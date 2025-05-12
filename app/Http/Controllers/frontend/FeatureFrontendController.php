<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\CompanyProfile;
use App\Models\FeatureDetailSection;
use Illuminate\Http\Request;

class FeatureFrontendController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        $companyProfile = CompanyProfile::all();
        return view('frontend.features', compact('features', 'companyProfile'));
    }

    public function show($id)
    {
        $feature = Feature::findOrFail($id);
        $companyProfile = CompanyProfile::all();
        $sections = FeatureDetailSection::where('feature_id', $id)->get();
        return view('frontend.feature-detail', compact('feature', 'sections', 'companyProfile'));
    }
}
