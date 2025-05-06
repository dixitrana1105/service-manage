<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client;
use App\Models\WhatsappAppointment;
use App\Models\CompanyProfile;


use Illuminate\Http\Request;

class WhatsappAppointmentController extends Controller
{
    public function bookAppointmentForm()
    {
        $companyProfile = CompanyProfile::all(); // Retrieve the first profile
        return view('frontend.customer.Whatsappappointment', compact('companyProfile'));
    }

    public function submitAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'whatsapp_number' => 'required',
            'message' => 'required',
        ]);

        $appointment = WhatsappAppointment::create($request->all());

        // Send WhatsApp Message via Twilio
        try {
            $sid = 'AC0f6c74003fd5fd55ed71dd272ca8625a';
            $token = '351a5a5f926d8203de9177d6fb4e5170';
            $twilio = new Client($sid, $token);

            $twilio->messages->create(
                'whatsapp:' . $request->whatsapp_number,
                [
                    'from' => 'whatsapp:+14155238886', // Twilio Sandbox Number
                    'body' => "Hello {$request->name}, your appointment request has been received. We’ll get back to you shortly. - Admin"
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Appointment saved, but WhatsApp message failed.');
        }

        return redirect()->back()->with('success', 'Appointment submitted and message sent via WhatsApp!');
    }
}
