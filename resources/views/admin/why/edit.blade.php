@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2><i class="fas fa-edit me-2 text-primary"></i> Edit Why Section</h2>
            <a href="{{ route('admin.why.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.why.update', $whySection->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $whySection->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="4"
                    required>{{ old('description', $whySection->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Current Image</label><br>
                @if($whySection->image)
                    <img src="{{ asset($whySection->image) }}" class="img-thumbnail mt-2" width="100" alt="Why Section Image">
                @else
                    <p class="text-muted">No image uploaded.</p>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Upload New Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)"
                    required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update
            </button>
        </form>
    </div>
@endsection