@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Edit Broadcast</h2>

        <form method="POST" action="{{ route('admin.broadcasts.update', $broadcast->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $broadcast->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control summernote" rows="4"
                    required>{!! old('message', $broadcast->message) !!}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Channel</label>
                <select name="channel" class="form-select" required>
                    <option value="email" {{ $broadcast->channel == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="sms" {{ $broadcast->channel == 'sms' ? 'selected' : '' }}>SMS</option>
                    <option value="whatsapp" {{ $broadcast->channel == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update Broadcast
            </button>
            <a href="{{ route('admin.broadcasts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection