@extends('admin.layouts.app')

@section('content')
    <div class="container mb-4 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2><i class="fas fa-info-circle me-2"></i>&nbsp;About Us</h2>
            @if ($aboutus->isEmpty())
                <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Add New About
                </a>
            @endif


        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col" class="text-center" style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aboutus as $about)
                        <tr>
                            <td>{{ $about->title }}</td>
                            <td>{{ Str::limit($about->description, 100) }}</td>
                            <td>
                                @if($about->image)
                                    <img src="{{ asset($about->image) }}" alt="About Image"
                                        class="rounded-circle shadow-sm img-thumbnail"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-sm btn-warning"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this About section?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No About Us entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection