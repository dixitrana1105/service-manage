@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h4>Add About Us</h4>
        <form action="{{ route('admin.aboutus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="aboutus_id" class="form-label">Select About Us Title</label>
                <select name="aboutus_id" id="aboutus_id" class="form-select" required>
                    <option value="">-- Select Title --</option>
                    @foreach ($aboutusTitles as $id => $title)
                        <option value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    accept="image/*" onchange="previewImage(event)" required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Create
            </button>
        </form>
    </div>
@endsection