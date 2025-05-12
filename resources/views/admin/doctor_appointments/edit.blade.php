@extends('admin.layouts.app')

@section('title', 'Edit Doctor Appointment')

@section('content')
    <div class="container mt-4">
        <h2><i class="fas fa-user-md me-2"></i>&nbsp; Edit Doctor Appointment</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="PUT" action="{{ route('admin.doctor-appointments.update', $doctor_appointment->id) }}">
            @csrf
            @method('PUT') <!-- Add this line to spoof PUT method -->

            <div class="mb-3">
                <label class="form-label">Patient Name</label>
                <input type="text" name="patient_name" class="form-control"
                    value="{{ old('patient_name', $doctor_appointment->patient_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor_appointment->email) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor_appointment->phone) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" class="form-control"
                    value="{{ old('appointment_date', $doctor_appointment->appointment_date) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Doctor Name</label>
                <input type="text" name="doctor_name" class="form-control"
                    value="{{ old('doctor_name', $doctor_appointment->doctor_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Designation</label>
                <input type="text" name="doctor_designation" class="form-control"
                    value="{{ old('doctor_designation', $doctor_appointment->doctor_designation) }}" required>

            </div>

            <div class="mb-3">
                <label class="form-label">Visit Days</label>
                @php
                    $selectedDays = old('visit_days', explode(',', $doctor_appointment->doctor_visit_days ?? ''));
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp
                <div class="row">
                    @foreach($days as $day)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visit_days[]" value="{{ $day }}"
                                    id="{{ strtolower($day) }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ strtolower($day) }}">{{ $day }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @php
                [$start_time, $end_time] = explode('-', $doctor_appointment->doctor_schedule ?? '-');
            @endphp

            <div class="mb-3">
                <label class="form-label">Time Schedule</label>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control"
                            value="{{ old('start_time', $start_time ?? '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control"
                            value="{{ old('end_time', $end_time ?? '') }}" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Holidays</label>
                <input type="text" name="doctor_holidays" class="form-control"
                    value="{{ old('doctor_holidays', $doctor_appointment->doctor_holidays) }}" required>

            </div>

            <div class="mb-3">
                <label class="form-label">Doctor Image</label>
                @if($doctor_appointment->doctor_image)
                    <div class="mb-2">
                        <img src="{{ asset($doctor_appointment->doctor_image) }}" alt="Doctor Image" width="60" height="60"
                            class="rounded-circle mb-1"><br>
                        <small class="text-muted"><strong>Path: </strong>{{ $doctor_appointment->doctor_image }}</small>
                    </div>
                @endif
                <input type="file" name="doctor_image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Update Appointment</button>
            <a href="{{ route('admin.doctor-appointments.index') }}" class="btn btn-secondary ms-2"><i
                    class="fas fa-arrow-left me-1"></i> Cancel</a>
        </form>
    </div>
@endsection