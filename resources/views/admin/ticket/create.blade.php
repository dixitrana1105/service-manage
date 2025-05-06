@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">
                    <i class="fas fa-ticket-alt nav-icon me-2"></i> Add Ticket Feature
                </h2>
                <a href="{{ route('admin.ticket.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    <strong style="font-family: 'Times New Roman', Times, serif;">Back to Ticket Feature</strong>
                </a>
            </div>
        </div>

        <form action="{{ route('admin.ticket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Choose Image:</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="mb-3" id="image-preview-container" style="display: none;">
                <label>Preview:</label><br>
                <img id="preview" src="#" alt="Image Preview"
                    style="max-width: 300px; border: 1px solid #ccc; padding: 5px;">
            </div>

            <button type="submit" class="btn btn-primary">Add Feature</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const container = document.getElementById('image-preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection