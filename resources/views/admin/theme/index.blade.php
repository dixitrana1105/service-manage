@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2><i class="fas fa-paint-roller nav-icon"></i>&nbsp;Theme Sections</h2>
            <a href="{{ route('admin.theme.create') }}" class="btn btn-success">+ Add Section</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Section</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Media</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                    <tr>
                        <td>{{ $section->section }}</td>
                        <td>{{ $section->title }}</td>
                        <td style="font-family: 'Times New Roman', Times, serif;">{!! $section->subtitle !!}</td>
                        <td>
                            @if($section->image)
                                @if($section->media_type === 'video')
                                    <video width="120" height="80">
                                        <source src="{{ asset($section->image) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <img src="{{ asset($section->image) }}" width="80" height="60" alt="Section Image">
                                @endif
                            @else
                                <span class="text-muted">No Media</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.theme.edit', $section->section) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>&nbsp;
                            <form action="{{ route('admin.theme.destroy', $section->id) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Are you sure you want to delete this section?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection