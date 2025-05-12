@extends('admin.layouts.app')

@section('title', 'Create Doctor Appointment')

@section('content')
    <div class="container mt-4">
        <h2>Create Doctor Appointment</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some problems with your input:</strong><br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.doctor-appointments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="patient_name" class="form-label">Patient Name</label>
                <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name"
                    value="{{ old('patient_name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email Address"
                    value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number"
                    value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date</label>
                <input type="date" name="appointment_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="doctor_name" class="form-label">Doctor Name</label>
                <input type="text" name="doctor_name" class="form-control" placeholder="Enter Doctor Name" required>
            </div>

            <div class="mb-3">
                <label for="doctor_designation" class="form-label">Designation</label>
                <input type="text" name="doctor_designation" class="form-control" placeholder="Enter Designation" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Visit Days</label>
                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doctor_visit_days[]" value="{{ $day }}"
                            id="{{ strtolower($day) }}">
                        <label class="form-check-label" for="{{ strtolower($day) }}">{{ $day }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label class="form-label">Time Schedule</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="doctor_holidays" class="form-label">Holidays</label>
                <input type="text" name="doctor_holidays" class="form-control" id="doctor_holidays"
                    placeholder="Enter Holidays" required>
            </div>

            <div class="mb-3">
                <label for="doctor_image" class="form-label">Doctor Image</label>
                <input type="file" name="doctor_image" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Save Appointment</button>
            <a href="{{ route('admin.doctor-appointments.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection