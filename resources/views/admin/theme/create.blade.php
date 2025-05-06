@extends('admin.layouts.app')

@section('title', 'Create Theme Section')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-paint-roller nav-icon me-2"></i>
                        Create New Theme Section
                    </h4>
                    <a href="{{ route('admin.theme.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        <strong style="font-family: 'Times New Roman', Times, serif;">Back to Theme</strong>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.theme.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Section Name -->
                    <div class="mb-3">
                        <label for="section" class="form-label">Section Name <span class="text-danger">*</span></label>
                        <input type="text" name="section" class="form-control @error('section') is-invalid @enderror"
                            id="section" placeholder="Enter section name" value="{{ old('section') }}" required>
                        @error('section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                            placeholder="Enter title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <textarea name="subtitle" class="form-control summernote @error('subtitle') is-invalid @enderror"
                            id="subtitle" rows="3" placeholder="Enter subtitle">{{ old('subtitle') }}</textarea>
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Section Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image"
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Upload Media (Image or Video)</label>
                        <input type="file" name="image" class="form-control" accept="image/*,video/*">
                    </div>


                    <!-- Submit Buttons -->
                    <button type="submit" class="btn btn-primary">Create Section</button>
                    <a href="{{ route('admin.theme.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection