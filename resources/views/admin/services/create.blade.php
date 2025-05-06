@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mt-4 mb-4"></h2>
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2><i class="fas fa-tools me-1 text-warning me-2"></i>&nbsp;Add New Service</h2>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>&nbsp;<strong style="font-family: 'Times New Roman', Times, serif;">Back to
                    Service</strong>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded shadow-sm bg-white">
            @csrf

            <div class="form-group mb-3">
                <label for="title" class="form-label">Service Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    placeholder="Enter service title" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Service Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"
                    placeholder="Write a short description" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="image" class="form-label">Service Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*"
                    onchange="previewImage(event)" required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
            </div>

            <!-- <div class="text-center">
                        <button type="submit" class="btn btn-success">Add Service</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div> -->
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Add Service</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-dark ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection