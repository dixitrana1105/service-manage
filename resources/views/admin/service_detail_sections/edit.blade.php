@extends('admin.layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                <h2 class="mb-0 d-flex align-items-center">
                <i class="fas fa-info bg-black text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;"></i>&nbsp;
                        Edit Service Detail Section
                </h2>
                <a href="{{ route('admin.service-detail-sections.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    <strong style="font-family: 'Times New Roman', Times, serif;">Back to Service Detail Section</strong>
                </a>
            </div>
    
    <form method="POST" action="{{ route('admin.service-detail-sections.update', $section->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

        <div class="mb-3">
            <label>Select Service</label>
            <select name="service_id" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $section->service_id == $service->id ? 'selected' : '' }}>{{ $service->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $section->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description Format</label>
            <select name="description_type" class="form-control" required>
                <option value="paragraph" {{ $section->description_type == 'paragraph' ? 'selected' : '' }}>Paragraph</option>
                <option value="bullet" {{ $section->description_type == 'bullet' ? 'selected' : '' }}>Bullet Points</option>
                <option value="numbered" {{ $section->description_type == 'numbered' ? 'selected' : '' }}>Numbered List</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control summernote" required>{!!  $section->description !!}</textarea>
            <small class="form-text text-muted">
                Use line breaks to separate points for bullet/numbered types.
            </small>
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            @if($section->image)
                <img src="{{ asset($section->image) }}" width="100"><br><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image Position</label>
            <select name="image_position" class="form-control" required>
                @foreach(['center','left','right','left top','left down','right top','right down','center top','center down'] as $position)
                    <option value="{{ $position }}" {{ $section->image_position == $position ? 'selected' : '' }}>
                        {{ ucfirst($position) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
