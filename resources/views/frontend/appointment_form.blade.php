@extends('frontend.layouts.main')

@section('main-container')
    <section class="book_appointment layout_padding py-5" style="background-color: #d9fdd3;">
        <div class="container">
            <h6 class="text-center display-4 has-line" style="color: #497ef1;" data-aos="fade-down"
                data-aos-duration="1000">
                <i class="fas fa-calendar-check me-2" style="color: #497ef1;"></i>
                Book Appointment
            </h6>
            <p class="text-center mb-4" style="color: #1a1a1a;" data-aos="fade-up" data-aos-duration="1200">
                Fill in the form below to book your appointment.
            </p>

            <div class="mb-4 w-50 mx-auto">
                <hr style="border-color: #1a1a1a;">
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="container">
                <div class="row justify-content-center">
                    @foreach($doctorAppointment as $doctor)
                        <div class="col-md-6 col-lg-5 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    @if(!empty($doctor->doctor_image))
                                        <div class="text-center mb-3">
                                            <img src="{{ asset($doctor->doctor_image) }}" alt="{{ $doctor->doctor_name }}"
                                                class="img-fluid rounded-circle" style="max-width: 120px;">
                                        </div>
                                    @endif

                                    <h4 class="card-title text-center text-primary">{{ $doctor->doctor_name ?? 'N/A' }}</h4>

                                    <p class="text-center mb-2">
                                        <strong>Designation:</strong> {{ $doctor->doctor_designation ?? 'N/A' }}
                                    </p>
                                    <p class="text-center mb-2">
                                        <strong>Availability:</strong> {{ $doctor->status ?? 'N/A' }}
                                    </p>
                                    <p class="text-center mb-2">
                                        <strong>Schedule:</strong> {{ $doctor->doctor_schedule ?? 'N/A' }}
                                    </p>
                                    <p class="text-center mb-3">
                                        <strong>Visit Days:</strong> {{ $doctor->doctor_visit_days ?? 'N/A' }}
                                    </p>

                                    <form action="{{ route('appointment.store') }}" method="POST" class="appointment-form">
                                        @csrf

                                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                        <input type="hidden" name="doctor_image" value="{{ $doctor->doctor_image }}">
                                        <input type="hidden" name="doctor_name" value="{{ $doctor->doctor_name }}">

                                        <div class="mb-3">
                                            <input type="text" name="patient_name" placeholder="Your Name" required
                                                class="form-control @error('patient_name') is-invalid @enderror"
                                                style="border-radius: 10px;">
                                            @error('patient_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" name="email" placeholder="Email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                style="border-radius: 10px;" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="text" name="phone" placeholder="Phone" required
                                                class="form-control @error('phone') is-invalid @enderror"
                                                style="border-radius: 10px;">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <input type="date" name="appointment_date" required
                                                class="form-control @error('appointment_date') is-invalid @enderror"
                                                style="border-radius: 10px;">
                                            @error('appointment_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <textarea name="message" rows="3" placeholder="Message"
                                                class="form-control @error('message') is-invalid @enderror"
                                                style="border-radius: 10px;">{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn px-4 py-2"
                                                style="background-color: #006400; color: white; border-radius: 50px; font-size: 16px;">
                                                Book Appointment
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection