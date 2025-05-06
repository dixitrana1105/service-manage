<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Storage;
use App\Models\Aboutus;
use App\Models\Page;
use App\Models\Subscribers;
use App\Models\User;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fetch the first record from Companyinfo and Company tables
        $companyProfile = CompanyProfile::first();
        $aboutus = Aboutus::first();
        // Fetch all pages ordered by name
        $pages = Page::where('showHome', 'Yes')->orderBy('name', 'asc')->get();
        // Fetch all pages ordered by name
        $servicepages = Page::where('showHome', 'Yes')->orderBy('name', 'asc')->get();
        // Fetch all subscribers
        $subscribers = Subscribers::all();
        // Fetch all users
        $user = User::where('created_at')->first();
        // Fetch all users who registered in the last 30 days
        $recentUsers = User::where('created_at', '>=', now()->subDays(30))->get();
        // Fetch all users who registered in the last 30 days
        $recentUsersCount = $recentUsers->count();
        // Fatch all data from Service table
        $services = Service::all(); // Make sure slug is selected
       


        // Share the variables globally with all views
        view()->share([
            'companyProfile' => $companyProfile,
            'logoUrl' => $companyProfile ? Storage::url($companyProfile->logo) : null,
            'faviconUrl' => $companyProfile ? Storage::url($companyProfile->favicon) : null,
            'company_name' => $companyProfile ? $companyProfile->company_name : null,
            'companyTagline' => $companyProfile ? $companyProfile->tagline : null,
            'companyDescription' => $companyProfile ? $companyProfile->description : null,
            'companyAddress' => $companyProfile ? $companyProfile->address : null,
            'companyPhone' => $companyProfile ? $companyProfile->phone : null,
            'companyEmail' => $companyProfile ? $companyProfile->email : null,
            'companyWebsite' => $companyProfile ? $companyProfile->website : null,
            'aboutus' => $aboutus,
            'pages' => $pages,
            'services' => $services,
            'servicepages' => $servicepages,
            'pageTitle' => $pages->pluck('name')->toArray(),
            'subscribers' => $subscribers,
            'subscribersCount' => $subscribers->count(),
            'subscribersEmail' => $subscribers->pluck('email')->toArray(),
            'subscribersCreatedAt' => $subscribers->pluck('created_at')->toArray(),
            'subscribersUpdatedAt' => $subscribers->pluck('updated_at')->toArray(),
            'subscribersId' => $subscribers->pluck('id')->toArray(),
            'user' => $user,
            'recentUsers' => $recentUsers,
            'recentUsersCount' => $recentUsersCount,
        ]);
    }
}
