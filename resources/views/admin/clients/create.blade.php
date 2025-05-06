@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2><i class="fas fa-user-plus me-2"></i></i> Add New Client</h2>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i><strong style="font-family: 'Times New Roman', Times, serif;">Back to Clients</strong> 
            </a>
        </div>

        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Client Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter client name" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position / Title</label>
                <input type="text" name="position" id="position" class="form-control" placeholder="e.g. CEO, Manager"
                    required>
            </div>

            <div class="mb-3">
                <label for="testimonial" class="form-label">Testimonial</label>
                <textarea name="testimonial" id="testimonial" rows="4" class="form-control"
                    placeholder="Write testimonial..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Client Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                <img id="preview" src="#" alt="Image Preview"
                    style="width: 150px; height: 150px; object-fit: cover; display: none;"
                    class="img-thumbnail shadow mt-2 rounded-circle">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Save Client
            </button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>
        document.getElementById("image").addEventListener("change", function () {
            const preview = document.getElementById("preview");
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block";
            } else {
                preview.src = "#";
                preview.style.display = "none";
            }
        });
    </script>
@endsection