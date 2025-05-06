@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Appointment</h3>

        <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $appointment->name }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $appointment->phone }}">
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" class="form-control">{{ $appointment->message }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection