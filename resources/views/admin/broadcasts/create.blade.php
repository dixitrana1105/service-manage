@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Create Broadcast</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please correct the errors below:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.broadcasts.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') }}" placeholder="Enter broadcast title" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control summernote @error('message') is-invalid @enderror" name="message" id="message" rows="4"
                    placeholder="Enter your message" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="channel" class="form-label">Channel</label>
                <select class="form-select @error('channel') is-invalid @enderror" name="channel" id="channel" required>
                    <option value="">Select channel</option>
                    <option value="email" {{ old('channel') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="sms" {{ old('channel') == 'sms' ? 'selected' : '' }}>SMS</option>
                    <option value="whatsapp" {{ old('channel') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                </select>
                @error('channel')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-paper-plane me-1"></i> Send Broadcast
            </button>
            <a href="{{ route('admin.broadcasts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection