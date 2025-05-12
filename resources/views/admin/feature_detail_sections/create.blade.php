@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="pt-4"></div>

        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <h2>
                <i class="fas fa-plus-circle text-success me-2"></i> Add Feature Detail Section
            </h2>
            <a href="{{ route('admin.feature-detail-sections.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.feature-detail-sections.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded bg-white shadow-sm">
            @csrf

            <div class="form-group mt-4">
                <label for="feature_id">Select Feature <span class="text-danger">*</span></label>
                <select id="feature_id" name="feature_id" class="form-control" required>
                    <option value="">-- Select Feature --</option>
                    @foreach($features as $feature)
                        <option value="{{ $feature->id }}">{{ $feature->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-4">
                <label>Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group mt-4">
                <label>Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group mt-4">
                <label>Description Type <span class="text-danger">*</span></label>
                <select name="description_type" class="form-control" required>
                    <option value="paragraph">Paragraph</option>
                    <option value="bullet">Bullet Points</option>
                    <option value="numbered">Numbered List</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <label>Image Position <span class="text-danger">*</span></label>
                <select name="image_position" class="form-control" required>
                    <option value="center">Center</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                    <option value="left top">Left Top</option>
                    <option value="left down">Left Down</option>
                    <option value="right top">Right Top</option>
                    <option value="right down">Right Down</option>
                    <option value="center top">Center Top</option>
                    <option value="center down">Center Down</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <label>Image <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" required onchange="previewImage(event)">
            </div>

            <div class="form-group mt-4">
                <label>Image Preview</label><br>
                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 300px;">

            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary px-4">Save</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = () => {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection