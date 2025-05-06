@extends('admin.layouts.app')

@section('content')
    <div class="container">
    <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">
                    <i class="fas fa-ticket-alt nav-icon me-2"></i>  Edit Ticket Feature
                </h2>
                <a href="{{ route('admin.ticket.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    <strong style="font-family: 'Times New Roman', Times, serif;">Back to Ticket Feature</strong>
                </a>
            </div>
        </div>
        
        <form action="{{ route('admin.ticket.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" value="{{ $feature->title }}" required>
            </div>

            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control" required>{{ $feature->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Upload New Image (optional):</label>
                <input type="file" name="image" class="form-control">

                @if ($feature->image_url)
                    <div class="mt-2">
                        <label>Current Image:</label><br>
                        <img src="{{ asset($feature->image_url) }}" width="100" style="border:1px solid #ddd; padding:3px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Feature</button>
        </form>
    </div>
@endsection