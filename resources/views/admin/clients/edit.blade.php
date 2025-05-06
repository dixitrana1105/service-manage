@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2><i class="fas fa-user-edit text-warning me-2"></i> Edit Client</h2>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i><strong style="font-family: 'Times New Roman', Times, serif;">Back to
                    Clients</strong>
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Client Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $client->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label fw-bold">Position</label>
                <input type="text" name="position" id="position" class="form-control"
                    value="{{ old('position', $client->position) }}" required>
            </div>

            <div class="mb-3">
                <label for="testimonial" class="form-label fw-bold">Testimonial</label>
                <textarea name="testimonial" id="testimonial" class="form-control" rows="4"
                    required>{{ old('testimonial', $client->testimonial) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Client Image</label>
                @if ($client->image)
                    <div class="mb-2">
                        <img src="{{ asset($client->image) }}" alt="{{ $client->name }}" class="img-thumbnail rounded-circle"
                            width="100" height="100" style="object-fit: cover;">
                        <br>
                        <small class="text-muted">Current Image</small>
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" accept="image/*"
                    onchange="previewImage(event)" required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
                <small class="text-muted">Leave blank if you do not want to change the image.</small>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Update Client
            </button>
        </form>
    </div>
@endsection