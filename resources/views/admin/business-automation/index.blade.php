@extends('admin.layouts.app')

@section('content')
    <div class="container">
    
        <h2 class="mb-4 mt-4"><i class="fas fa-robot nav-icon"></i>&nbsp;Manage Business Automation</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.business-automation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $data->title ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-control"
                    required>{{ old('description', $data->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Image</label>
                @if(!empty($data->image))
                    <img src="{{ asset($data->image) }}" width="100" class="mb-2"><br>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)"
                    required>

                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
            </div>

            <div class="mb-3">
                <label>Key Benefits (one per line)</label>
                <textarea name="benefits[]" class="form-control summernote" rows="5" 
                    required>{{ isset($data->benefits) ? implode("\n", $data->benefits) : '' }}</textarea>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection