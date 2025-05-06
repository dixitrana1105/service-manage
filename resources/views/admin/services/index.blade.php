@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <!-- Heading -->
        <h1 class="mt-4 mb-4">
            <i class="fas fa-concierge-bell"></i>&nbsp; Manage Services
        </h1>

        <!-- Button aligned to the right -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                Add New Service
            </a>
        </div>

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Services Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $service->title }}</td>
                            <td>{{ Str::limit($service->description, 80) }}</td>
                            <td>
                                @if($service->image)
                                    <img src="{{ asset($service->image) }}" alt="Service Image"
                                        class="img-thumbnail d-block mx-auto" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                    class="btn btn-sm btn-warning me-1">Edit</a>

                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted text-center">No services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection