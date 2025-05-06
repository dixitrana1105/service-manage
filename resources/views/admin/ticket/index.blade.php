@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h2 class="mb-0"><i class="fas fa-ticket-alt nav-icon"></i>&nbsp;WhatsApp Ticket Features</h2>
            <a href="{{ route('admin.ticket.create') }}" class="btn btn-success">Add Feature</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($features as $feature)
                    <tr>
                        <td>{{ $feature->title }}</td>
                        <td>{{ $feature->description }}</td>
                        <td><img src="{{ asset($feature->image_url) }}" width="40"></td>
                        <td>
                            <a href="{{ route('admin.ticket.edit', $feature->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.ticket.destroy', $feature->id) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection