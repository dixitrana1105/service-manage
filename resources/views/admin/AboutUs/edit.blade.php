@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-edit me-2 mb-4 mt-4"></i>&nbsp;Edit About Us</h2>
            <a href="{{ route('admin.about.index') }}" class="btn btn-secondary mb-4 mt-4">
                <i class="fas fa-arrow-left me-1"></i>&nbsp; Back to About Us
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Please fix the following errors:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.about.update', $aboutus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $aboutus->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="4" required>{{ old('description', $aboutus->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    accept=".jpg,.jpeg,.png,.gif">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if($aboutus->image)
                    <div class="mt-3">
                        <img src="{{ asset($aboutus->image) }}" alt="About Image" class="img-thumbnail shadow rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Update
            </button>
        </form>
        
    </div>
@endsection