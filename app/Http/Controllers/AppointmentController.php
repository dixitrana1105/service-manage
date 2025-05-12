<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorAppointment;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function create()
    {
        $companyProfile = CompanyProfile::all();
        $doctorAppointment = DoctorAppointment::all(); // Get only one doctor
        return view('frontend.appointment_form', compact('companyProfile', 'doctorAppointment'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctor_appointments,id', // Ensure doctor_id exists in the doctors table
            'patient_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'appointment_date' => 'required|date',
            'doctor_name' => 'required|string|max:255',
            'doctor_image' => 'nullable|string', // If you're not updating the image
        ]);

        // Create a new appointment
        $appointment = new DoctorAppointment();
        $appointment->doctor_id = $validatedData['doctor_id'];
        $appointment->patient_name = $validatedData['patient_name'];
        $appointment->email = $validatedData['email'] ?? null;
        $appointment->phone = $validatedData['phone'];
        $appointment->message = $validatedData['message'] ?? null;
        $appointment->appointment_date = $validatedData['appointment_date'];
        $appointment->doctor_name = $validatedData['doctor_name'];
        $appointment->doctor_image = $validatedData['doctor_image']; // Store the image path if exists

        // Store the appointment in the database
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment booked successfully.');
    }


    public function showAppointmentForm()
    {
        $doctors = DoctorAppointment::all(); // Fetch only available/active doctors
        $companyProfile = CompanyProfile::all();
        return view('frontend.book', compact('doctors', 'companyProfile'));
    }
}
