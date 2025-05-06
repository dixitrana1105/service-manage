@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-question-circle text-primary me-2 mb-4 mt-4"></i> Manage Why Section</h2>
        <a href="{{ route('admin.why.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($whySections as $section)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $section->title }}</td>
                    <td>{{ Str::limit($section->description, 100) }}</td>
                    <td>
                        @if($section->image)
                            <img src="{{ asset($section->image) }}" alt="Why Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.why.edit', $section->id) }}" class="btn btn-sm btn-warning mb-1">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.why.destroy', $section->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
