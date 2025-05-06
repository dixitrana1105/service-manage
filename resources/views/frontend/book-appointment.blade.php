@extends('frontend.layouts.main')

@section('main-container')
<div class="container mt-5">
    <h2>Book Your Appointment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('appointment.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>WhatsApp Number</label>
            <input type="text" name="whatsapp_number" class="form-control" required>
            @error('whatsapp_number')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Book Appointment</button>
    </form>
</div>
@endsection
