<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Branch;
use App\Models\Client;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Subscribers;
use App\Models\CompanyGrowth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use App\Models\Employee;

class AdminHomeController extends Controller
{
    public function index()
    {

        $companyProfile = CompanyProfile::first();
        $clientCount = Client::count();
        $serviceCount = Service::count();
        $appointmentCount = Appointment::count();
        $userCount = User::count();
        $subscriberCount = Subscribers::count();
        $growthData = CompanyGrowth::orderBy('year')->get();

        $growthYears = $growthData->pluck('year')->toArray();     // ['2019', '2020', ...]
        $growthRevenue = $growthData->pluck('revenue')->toArray(); // [2.5, 3.8, ...]

        
        return view('admin.dashboard', compact(
            'companyProfile',
            'clientCount',
            'serviceCount',
            'appointmentCount',
            'userCount',
            'subscriberCount',
            'growthYears',
            'growthRevenue'     
        ));
    }


    public function clearCache()
    {
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');

        return redirect()->back()->with('success', 'Cache cleared successfully!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
