@extends('frontend.layouts.main')

@section('main-container')
    <section class="book_appointment layout_padding py-5" style="background-color: #d9fdd3;">
        <div class="container">
            <h6 class="text-center display-4 has-line" style="color: #497ef1;" data-aos="fade-down" data-aos-duration="1000">
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

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('customer.appointment.store') }}" method="POST" class="appointment-form">
                        @csrf

                        <!-- Customer Name -->
                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1300">
                            <label for="customer_name" class="form-label" style="color: #1a1a1a; font-weight: bold;">Name:</label>
                            <input type="text" id="customer_name" name="customer_name" required
                                class="form-control @error('customer_name') is-invalid @enderror" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Customer Email -->
                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1400">
                            <label for="customer_email" class="form-label" style="color: #1a1a1a; font-weight: bold;">Email:</label>
                            <input type="email" id="customer_email" name="customer_email" required
                                class="form-control @error('customer_email') is-invalid @enderror" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Appointment Date -->
                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1500">
                            <label for="appointment_date" class="form-label" style="color: #1a1a1a; font-weight: bold;">Date:</label>
                            <input type="date" id="appointment_date" name="appointment_date" required
                                class="form-control @error('appointment_date') is-invalid @enderror" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">
                            @error('appointment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Appointment Time -->
                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1600">
                            <label for="appointment_time" class="form-label" style="color: #1a1a1a; font-weight: bold;">Time:</label>
                            <input type="time" id="appointment_time" name="appointment_time" required
                                class="form-control @error('appointment_time') is-invalid @enderror" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">
                            @error('appointment_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3" data-aos="fade-up" data-aos-duration="1700">
                            <label for="message" class="form-label" style="color: #1a1a1a; font-weight: bold;">Message:</label>
                            <textarea id="message" name="message"
                                class="form-control @error('message') is-invalid @enderror" rows="4" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;"></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center" data-aos="fade-up" data-aos-duration="1800">
                            <button type="submit" class="btn px-4 py-2" 
                                style="background-color: #006400; color: white; border-radius: 50px; border: none; padding: 12px 30px; font-size: 18px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); transition: all 0.3s;">
                                Book Appointment
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

