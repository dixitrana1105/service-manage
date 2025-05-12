@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3" style="margin-top: 20px;">
        <h2 style="margin-left: 20px;">All Features</h2>
        <a href="{{ route('admin.features.create') }}" class="btn btn-success">Add Feature</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($features as $feature)
                <tr>
                    <td><i class="{{ $feature->icon }}"></i></td>
                    <td>{{ $feature->title }}</td>
                    <td>{{ Str::limit($feature->description, 50) }}</td>
                    <td>
                        @if($feature->image)
                            <img src="{{ asset($feature->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.features.edit', $feature->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.features.destroy', $feature->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this feature?')"
                                class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection