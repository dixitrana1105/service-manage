<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Team;
use App\Models\WhySection;
use App\Models\Service;
use App\Models\CompanyProfile;
use App\Models\Aboutus;
use App\Models\Page;
use App\Models\ThemeSection;
use App\Models\WhatsappTicketFeature;
use App\Models\Subscribers;
use App\Models\WhatsAppPreview;
use App\Models\WhatsappFlow;
use Illuminate\Support\Facades\Storage;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Route;

class HomeController extends Controller
{

    public function clearCache()
    {
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        return redirect()->back()->with('success', 'You have Successfully Cashclear !');
    }
    public function index()
    {
        $clients = Client::all();
        $teams = Team::all();
        $whySections = WhySection::all();
        $services = Service::all();
        $companyProfile = CompanyProfile::all();
        $aboutus = Aboutus::all();
        $banner = ThemeSection::all(); // example logic
        if (Route('home')) {
            // Home page: show all pages
            $pages = Page::orderByRaw("CASE WHEN showHome = 'Yes' THEN 0 ELSE 1 END")
            ->orderBy('name', 'ASC')
            ->where('showHome', 'Yes')
            ->get();
        } else {
            // Other pages: show only those with showHome = 'Yes'
            $pages = Page::orderByRaw("CASE WHEN showHome = 'Yes' THEN 0 ELSE 1 END")
                ->orderBy('name', 'ASC')
                ->where('showHome', 'Yes')
                ->get();
        }
        $ticketFeatures = WhatsappTicketFeature::all();
        $subscribers = Subscribers::all();
        $preview = WhatsAppPreview::first();
        $flow = WhatsappFlow::first();
        return view('frontend.index', compact('clients', 'teams', 'whySections',
         'services', 'companyProfile', 'aboutus', 'pages', 'banner', 'ticketFeatures', 'subscribers', 'preview', 'flow'));
    }

}
