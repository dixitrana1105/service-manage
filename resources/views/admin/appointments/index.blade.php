@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4"
            style="font-family: 'Times New Roman', Times, serif;">
            <h2><i class="fas fa-calendar-check me-2"></i> Appointment Bookings</h2>
        </div>

        @if($appointments->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-info-circle me-1"></i> No appointments have been booked yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr class="align-middle text-center">
                            <th class="fs-6 px-3 py-2" style="width: 15%;">ID</th>
                            <th class="fs-6 px-3 py-2" style="width: 15%;">Name</th>
                            <th class="fs-6 px-3 py-2" style="width: 25%;">Email</th>
                            <th class="fs-6 px-3 py-2" style="width: 10%;">Date</th>
                            <th class="fs-6 px-3 py-2" style="width: 10%;">Time</th>
                            <th class="fs-6 px-3 py-2" style="width: 25%;">Message</th>
                            <th class="fs-6 px-3 py-2" style="width: 15%;">Actions</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                                    <tr class="text-center align-middle">
                                    <td class="fs-6">{{ $appointment->id }}</td>
                                        <td class="fs-6">{{ $appointment->customer_name }}</td>

                                        <td class="fs-6 text-start">
                                            @php
                                                $email = $appointment->customer_email;
                                                $domain = Str::after($email, '@');
                                            @endphp

                                            <a href="mailto:{{ $email }}"
                                                class="text-uppercase text-decoration-none d-flex align-items-center">
                                                @if (Str::contains($domain, 'gmail'))
                                                    <img src="{{ asset('assets/admin-assets/img/icons/gmail.png') }}" alt="Gmail" width="60"
                                                        class="me-2">&nbsp;<br>
                                                @elseif (Str::contains($domain, 'outlook'))
                                                    <img src="{{ asset('assets/admin-assets/img/icons/outlook.png') }}" alt="Outlook" width="60"
                                                        class="me-2">&nbsp;
                                                @elseif (Str::contains($domain, 'hotmail'))
                                                    <img src="{{ asset('assets/admin-assets/img/icons/hotmail.png') }}" alt="Hotmail" width="60"
                                                        class="me-2">&nbsp;
                                                @else
                                                    <img src="{{ asset('assets/admin-assets/img/icons/default-mail.png') }}" alt="Email"
                                                        width="60" class="me-2">&nbsp;
                                                @endif
                                                <span>{{ $email }}</span>
                                            </a>
                                        </td>

                                        <td class="mb-2 fs-6">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}
                                        </td>

                                        <td class="mb-2 fs-6">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </td>

                                        <td class="fs-4 text-start">
                                            {{ Str::limit(strip_tags($appointment->message), 50) }}
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this appointment?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
@endsection