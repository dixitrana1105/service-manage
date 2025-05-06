@extends('frontend.layouts.main')

@section('main-container')
    <div class="container py-5">
        <h2>Book Your Appointment</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('appointment.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email (optional)</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>WhatsApp Number (with country code)</label>
                <input type="text" name="whatsapp_number" class="form-control" required placeholder="+91XXXXXXXXXX">
            </div>
            <div class="mb-3">
                <label>Message</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Send via WhatsApp</button>
        </form>
    </div>
@endsection