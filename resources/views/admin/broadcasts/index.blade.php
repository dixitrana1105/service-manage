@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">
                <div class="d-flex align-items-center">
                    <i class="bi bi-megaphone-fill text-primary bg-white text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width: 30px; height: 30px;"></i>&nbsp;
                    <span class="ms-2">Broadcast List</span>
                </div>
            </h2>
            <a href="{{ route('admin.broadcasts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Create Broadcast
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Channel</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($broadcasts as $broadcast)
                        <tr>
                            <td>{{ $broadcast->title }}</td>
                            <td>{{ ucfirst($broadcast->channel) }}</td>
                            <td>{{ $broadcast->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.broadcasts.edit', $broadcast->id) }}"
                                    class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.broadcasts.destroy', $broadcast->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this broadcast?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No broadcasts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection