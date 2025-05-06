@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2><i class="fas fa-plus-circle text-success me-2"></i> Add New Why Section</h2>
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

    <form action="{{ route('admin.why.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Enter description" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*"  onchange="previewImage(event)" required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save me-1"></i> Save
        </button>
    </form>
</div>
@endsection
