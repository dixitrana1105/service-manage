<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorAppointment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $appointments = DoctorAppointment::latest()->get();
        return view('admin.doctor_appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('admin.doctor_appointments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'appointment_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'doctor_designation' => 'required|string|max:255',
            'doctor_visit_days' => 'required|array',
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_holidays' => 'required|string',
            'doctor_image' => 'nullable|image|max:2048',
            'status' => 'nullable|in:Pending,Confirmed,Cancelled',
        ]);

        // Format time schedule
        $data['doctor_schedule'] = date("g:i A", strtotime($request->start_time)) . ' - ' . date("g:i A", strtotime($request->end_time));

        // Convert visit_days array to string
        $data['doctor_visit_days'] = implode(',', $request->doctor_visit_days);

        // Upload doctor image
        if ($request->hasFile('doctor_image')) {
            $image = $request->file('doctor_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/doctors'), $imageName);
            $data['doctor_image'] = 'uploads/doctors/' . $imageName; // Save path relative to public
        }

        DoctorAppointment::create($data);

        return redirect()->route('admin.doctor-appointments.index')->with('success', 'Appointment created successfully.');
    }


    public function edit($id)
    {
        $doctor_appointment = DoctorAppointment::findOrFail($id);
        return view('admin.doctor_appointments.edit', compact('doctor_appointment'));
    }

    public function update(Request $request, DoctorAppointment $doctor_appointment)
    {
        $data = $request->validate([
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'appointment_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'doctor_designation' => 'required|string|max:255',
            'doctor_visit_days' => 'required|array',
            'start_time' => 'required',
            'end_time' => 'required',
            'doctor_holidays' => 'required|string',
            'doctor_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:Pending,Confirmed,Cancelled',
        ]);

        // Format time
        $data['doctor_schedule'] = date("g:i A", strtotime($request->start_time)) . ' - ' . date("g:i A", strtotime($request->end_time));

        // Convert array to string
        $data['doctor_visit_days'] = implode(',', $request->doctor_visit_days);

        // Handle image
        if ($request->hasFile('doctor_image')) {
            if ($doctor_appointment->doctor_image && file_exists(public_path($doctor_appointment->doctor_image))) {
                unlink(public_path($doctor_appointment->doctor_image));
            }

            $image = $request->file('doctor_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/doctors'), $imageName);
            $data['doctor_image'] = 'uploads/doctors/' . $imageName;
        }

        // Update the model
        $doctor_appointment->update($data);

        return redirect()->route('admin.doctor_appointments.index')->with('success', 'Appointment updated successfully.');
    }



    public function destroy(DoctorAppointment $doctor_appointment)
    {
        if ($doctor_appointment->doctor_image) {
            Storage::disk('public')->delete($doctor_appointment->doctor_image);
        }

        $doctor_appointment->delete();

        return redirect()->route('admin.doctor-appointments.index')->with('success', 'Doctor Appointment Deleted');
    }
    public function changeStatus(Request $request)
    {
        // You can validate and handle the status change logic here
        $request->validate([
            'appointment_id' => 'required|exists:doctor_appointments,id',
            'status' => 'required|in:Pending,Confirmed,Cancelled',
        ]);

        $row = new DoctorAppointment();
        $row->status = $request->status;
        $row->save();

        return redirect()->route('admin.doctor-appointments.index')->with('success', 'Appointment status updated successfully.');
    }
}
