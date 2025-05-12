<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    CompanyProfile,
    Aboutus,
    Page,
    Subscribers,
    User,
    Service,
    DoctorAppointment,
    Broadcast,
    Feature,
    FeatureDetailSection
};

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
        // Company Info
        $companyProfile = CompanyProfile::first();

        // Pages
        $pages = Page::where('showHome', 'Yes')->orderBy('name')->get();

        // About Us
        $aboutus = Aboutus::first();

        // Subscribers
        $subscribers = Subscribers::all();

        // Services
        $services = Service::all();

        // Doctor Appointments
        $doctorAppointment = DoctorAppointment::all();

        // Users
        $user = User::first(); // Or authenticated user if needed
        $recentUsers = User::where('created_at', '>=', now()->subDays(30))->get();

        // Broadcasts
        $broadcasts = Broadcast::latest()->take(5)->get();
        // You can also pass the broadcasts to the view if needed
        // $broadcasts = Broadcast::latest()->take(5)->get();
        // Features
        $features = Feature::all();
        // Feature Details
        $featureDetails = FeatureDetailSection::all();


        // Share with all views
        view()->share([
            // Company
            'companyProfile' => $companyProfile,
            'logoUrl' => $companyProfile ? Storage::url($companyProfile->logo) : null,
            'faviconUrl' => $companyProfile ? Storage::url($companyProfile->favicon) : null,
            'company_name' => $companyProfile->company_name ?? null,
            'companyTagline' => $companyProfile->tagline ?? null,
            'companyDescription' => $companyProfile->description ?? null,
            'companyAddress' => $companyProfile->address ?? null,
            'companyPhone' => $companyProfile->phone ?? null,
            'companyEmail' => $companyProfile->email ?? null,
            'companyWebsite' => $companyProfile->website ?? null,

            // Content
            'aboutus' => $aboutus,
            'pages' => $pages,
            'pageTitle' => $pages->pluck('name')->toArray(),
            'services' => $services,
            'servicepages' => $pages, // if same as above

            // Subscribers
            'subscribers' => $subscribers,
            'subscribersCount' => $subscribers->count(),
            'subscribersEmail' => $subscribers->pluck('email')->toArray(),
            'subscribersCreatedAt' => $subscribers->pluck('created_at')->toArray(),
            'subscribersUpdatedAt' => $subscribers->pluck('updated_at')->toArray(),
            'subscribersId' => $subscribers->pluck('id')->toArray(),

            // Users
            'user' => $user,
            'recentUsers' => $recentUsers,
            'recentUsersCount' => $recentUsers->count(),

            // Appointments
            'doctorAppointment' => $doctorAppointment,

            // Broadcasts
            'broadcasts' => $broadcasts,
            'broadcastsCount' => $broadcasts->count(),
            // Features
            'features' => $features,
            // Feature Details
            'featureDetails' => $featureDetails,
        ]);
    }
}
