@extends('admin.layouts.app')

@section('content')
<div class="container mb-2">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2><i class="fas fa-handshake nav-icon"></i>&nbsp; Clients</h2>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Add New Client
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Testimonial</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->position }}</td>
                        <td style="max-width: 300px;">{{ Str::limit($client->testimonial, 100) }}</td>
                        <td class="text-center">
                            @if($client->image)
                                <img src="{{ asset($client->image) }}" alt="{{ $client->name }}"
                                    class="img-thumbnail rounded-circle text-center" width="80" height="80"
                                    style="object-fit: cover;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                  style="display:inline-block;"
                                  onsubmit="return confirm('Are you sure you want to delete this client?');">
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
                        <td colspan="5" class="text-center text-muted">No clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
