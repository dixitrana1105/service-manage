@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="mb-0">
                <i class="fas fa-paint-roller nav-icon me-2"></i>
                Edit Theme Section - {{ $data->section }}
            </h2>
            <a href="{{ route('admin.theme.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                <strong style="font-family: 'Times New Roman', Times, serif;">Back to Theme</strong>
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>There were some errors with your submission:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.theme.update', $data->section) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}">
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitle</label>
                <textarea name="subtitle" class="form-control summernote"
                    rows="4">{!! old('subtitle', $data->subtitle) !!}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Media</label><br>
                @if ($data->image)
                    @if ($data->media_type === 'video')
                        <video width="240" height="160" controls>
                            <source src="{{ asset($data->image) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img src="{{ asset($data->image) }}" width="120" height="90" alt="Current Image" style="object-fit: cover;">
                    @endif
                @else
                    <p class="text-muted">No media uploaded.</p>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload New Media (Image or Video)</label>
                <input type="file" name="image" class="form-control" accept="image/*,video/*">

                <small class="text-muted">Max size: 10MB | Accepted formats: jpg, jpeg, png, gif, mp4, avi, mov, wmv</small>
            </div>

            <button type="submit" class="btn btn-success">Update Section</button>
            <a href="{{ route('admin.theme.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection