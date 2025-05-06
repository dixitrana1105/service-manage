<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Models\CompanyProfile;
use App\Models\ThemeSection;
use App\Models\ServiceDetailSection; 
class ServiceController extends Controller
{
      // Frontend: Show all services
      public function index()
      {
          $services = Service::all();
          $companyProfile = CompanyProfile::all(); // Retrieve the first profile
          $banner = ThemeSection::all(); // example logic
          return view('frontend.service', compact('services', 'companyProfile', 'banner'));
      }
  
      // Admin: Show all services (For managing services in the admin panel)
      public function adminIndex()
      {
          $services = Service::all();
          return view('admin.services.index', compact('services'));
      }
  
      // Admin: Show form to create a new service
      public function create()
      {
          return view('admin.services.create');
      }
  
      // Admin: Store a new service
      public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('uploads/services'), $imageName);

    Service::create([
        'title' => $request->title,
        'description' => $request->description,
        'image' => 'uploads/services/' . $imageName,
    ]);

    return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
}

  
      // Admin: Show the form to edit a service
      public function edit($id)
      {
          $service = Service::findOrFail($id);
          return view('admin.services.edit', compact('service'));
      }
  
      // Admin: Update a service
      public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $service = Service::findOrFail($id);

    if ($request->hasFile('image')) {
        if ($service->image && file_exists(public_path($service->image))) {
            unlink(public_path($service->image));
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/services'), $imageName);
        $service->image = 'uploads/services/' . $imageName;
    }

    $service->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
}

  
      // Admin: Delete a service
      public function destroy($id)
{
    $service = Service::findOrFail($id);

    if ($service->image && file_exists(public_path($service->image))) {
        unlink(public_path($service->image));
    }

    $service->delete();

    return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
}
public function show($id)
{
    $service = Service::findOrFail($id);
    $sections = ServiceDetailSection::where('service_id', $id)->get();
    $companyProfile = CompanyProfile::all(); // Retrieve the first profile
    return view('frontend.service-detail', compact('service', 'sections', 'companyProfile'));
}

}
