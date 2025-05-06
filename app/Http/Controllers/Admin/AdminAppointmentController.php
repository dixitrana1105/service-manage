<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminAppointmentController extends Controller
{
    // Show all appointments
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.appointments.index', compact('appointments'));
    }

    // Show edit form
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.appointments.edit', compact('appointment'));
    }

    // Update appointment
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->only('name', 'phone', 'message'));

        return redirect()->route('admin.appointments.index')
                         ->with('success', 'Appointment updated successfully.');
    }

    // Delete appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
                         ->with('success', 'Appointment deleted successfully.');
    }
}
