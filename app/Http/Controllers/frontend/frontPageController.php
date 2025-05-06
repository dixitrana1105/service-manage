<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\CompanyProfile;
use App\Models\Aboutus;
use App\Models\Service;
use App\Models\ThemeSection;
use Illuminate\Http\Request;

class frontPageController extends Controller
{
    public function show()
    {
        // Fetch all pages ordered by name
        $pages = Page::where('showHome', 'Yes')->orderBy('name', 'asc')->get();
        // Return the view with the pages data
        $companyProfile = CompanyProfile::all();
        $aboutus = Aboutus::all();
        $services = Service::all();
        $banner = ThemeSection::all(); // example logic            
        return view('frontend.about', compact('pages', 'companyProfile', 'aboutus', 'services', 'banner'));
    }

    public function services($slug, $id)
    {
        if (route('frontend.services.index')) {
            // Home page: show all pages
            $servicepages = Page::orderByRaw("CASE WHEN showHome = 'Yes' THEN 0 ELSE 1 END")
            ->orderBy('name', 'ASC')
            ->where('showHome', 'Yes')
            ->get();
        } else {
            // Other pages: show only those with showHome = 'Yes'
            $servicepages = Page::orderByRaw("CASE WHEN showHome = 'Yes' THEN 0 ELSE 1 END")
                ->orderBy('name', 'ASC')
                ->where('showHome', 'Yes')
                ->get();
        }
        

        $companyProfile = CompanyProfile::all();
        $aboutus = Aboutus::all();
        $services = Service::all(); // Make sure slug is selected
        $banner = ThemeSection::all();

        return view('frontend.layouts.header', compact('servicepages', 'companyProfile', 'aboutus', 'services', 'banner'));
    }

}
