@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>All Appointments</h2>

    <table class="table table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>WhatsApp</th>
                <th>Message</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($whatsappappointments as $appt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appt->name }}</td>
                    <td>{{ $appt->email }}</td>
                    <td>{{ $appt->whatsapp_number }}</td>
                    <td>{{ $appt->message }}</td>
                    <td>{{ $appt->created_at->format('d M Y h:i A') }}</td>
                </tr>
            @empty
                <tr><td colspan="6">No appointments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
