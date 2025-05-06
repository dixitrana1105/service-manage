@extends('admin.layouts.app')

@section('content')
<div class="container mb-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fas fa-info bg-black text-dark rounded-circle d-inline-flex align-items-center justify-content-center"
        style="width: 40px; height: 40px;"></i>&nbsp;Service Detail Sections</h2>
        <a href="{{ route('admin.service-detail-sections.create') }}" class="btn btn-success">Add Section</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td>{{ $section->service->title }}</td>
                <td>{{ $section->title }}</td>
                <td>{!! Str::limit(strip_tags($section->description), 50) !!}</td>
                <td>
                    @if($section->image)
                    <img src="{{ asset($section->image) }}" width="100">
                    @endif
                </td>
                <td style="white-space: nowrap;">
                    <a href="{{ route('admin.service-detail-sections.edit', $section->id) }}" title="Edit" style="color: #ffc107; margin-right: 10px; display: inline-block;">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.service-detail-sections.destroy', $section->id) }}" method="POST" style="display: inline-block; margin: 0; padding: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this?')" title="Delete" style="border: none; background: transparent; color: #dc3545; padding: 0;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
                
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
