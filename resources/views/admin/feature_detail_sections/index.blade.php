@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="pt-4"></div>

        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <h2 class="mb-0">
                <i class="fas fa-cogs text-success me-2"></i> Feature Detail Sections
            </h2>
            <a href="{{ route('admin.feature-detail-sections.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Add New
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Feature</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Image Position</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $section->feature->title }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{{ ucfirst($section->description_type) }}</td>
                            <td>{{ ucfirst($section->image_position) }}</td>
                            <td>
                                @if($section->image)
                                    <img src="{{ asset($section->image) }}" alt="{{ $section->title }}" class="section-img"
                                        style="max-height: 80px;">
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.feature-detail-sections.edit', $section->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.feature-detail-sections.destroy', $section->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No feature detail sections found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection