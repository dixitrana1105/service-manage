@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0 d-flex align-items-center">
                <i class="fas fa-info bg-black text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;"></i>&nbsp;
                    Add Service Detail Section
                </h2>
                <a href="{{ route('admin.service-detail-sections.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    <strong style="font-family: 'Times New Roman', Times, serif;">Back to Service Detail Section</strong>
                </a>
            </div>
        </div>
        <form action="{{ route('admin.service-detail-sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="service_id">Select Service <span class="text-danger">*</span></label>
                <select id="service_id" name="service_id" class="form-control" required>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" data-section-id="{{ $service->existing_section_id ?? '' }}">
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Section Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Section Description</label>
                <textarea name="description" class="form-control summernote" rows="5"
                    placeholder="Enter the description content" required></textarea>
                <small class="form-text text-muted">
                    Use line breaks to separate points for bullet/numbered types.
                </small>
            </div>

            <div class="form-group">
                <label for="description_type">Description Format</label>
                <select name="description_type" class="form-control" required>
                    <option value="paragraph">Paragraph</option>
                    <option value="bullet">Bullet Points</option>
                    <option value="numbered">Numbered List</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image_position">Image Position</label>
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

            <!-- Image Upload Field -->
            <div class="form-group">
                <label for="image">Section Image</label>
                <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
            </div>

            <!-- Image Preview -->
            <div class="form-group">
                <label>Image Preview</label><br>
                <img id="imagePreview" src="#" alt="Image Preview"
                    style="display: none; max-width: 300px; max-height: 300px;" />
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- JavaScript to Handle Image Preview -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';  // Show the image preview
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- JavaScript to handle existing section check -->
    <script>
        document.getElementById('service_id').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var sectionId = selectedOption.getAttribute('data-section-id');

            if (sectionId) {
                if (confirm("This service already has a section. Do you want to update it instead?")) {
                    window.location.href = `/admin/service-detail-sections/${sectionId}/edit`;
                } else {
                    this.selectedIndex = 0; // Reset dropdown
                }
            }
        });
    </script>
@endsection