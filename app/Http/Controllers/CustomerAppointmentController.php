<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\CompanyProfile;
use App\Models\ThemeSection;
use App\Mail\AppointmentDetailsMail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class CustomerAppointmentController extends Controller
{
    // Show the appointment booking form
    public function create()
    {
        $companyProfile = CompanyProfile::all();
        $banner = ThemeSection::all();

        return view('frontend.customer.appointment', compact('companyProfile', 'banner'));
    }

    // Store the appointment and send email
    public function store(Request $request)
    {
        $customMessages = [
            'customer_email.unique' => 'This mail ID is already used.',
            'message.min' => 'The message must be at least 20 to 50 characters.',
        ];
        // Validate the request data
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => [
                'required',
                'email',
                'unique:appointments,customer_email',
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['gmail.com', 'hotmail.com', 'outlook.com'];
                    $emailDomain = substr(strrchr($value, "@"), 1);

                    if (!in_array($emailDomain, $allowedDomains)) {
                        $fail("The $attribute must be a Gmail, Hotmail, or Outlook address.");
                    }
                },
            ],
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'message' => 'required|string|min:20|max:500',
        ], $customMessages);


        // Save appointment to database
        $appointment = Appointment::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'message' => $request->message,
        ]);
        $appointment->save();

        // Get first company profile
        $company = CompanyProfile::all();

        // Send appointment details email to admin
        Mail::to($request->customer_email)->send(new AppointmentDetailsMail($appointment, $company));
        

        return redirect()->route('customer.appointment.create')
            ->with('success', 'Appointment booked successfully.');
    }
}
