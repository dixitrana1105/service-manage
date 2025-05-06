@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit WhatsApp Chatbot</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.whatsapp.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $data->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">Image:</label>
            @if($data->image)
                <div class="mb-2">
                    <img src="{{ asset($data->image) }}" width="150" class="img-thumbnail">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="preview" src="#" style="max-width: 150px; display: none;" class="img-thumbnail">
            </div>
        </div>

        <div class="mb-3">
            <label for="features">Features (one per line):</label>
            <textarea name="features[]" class="form-control summernote" rows="5" required>{{ old('features.0', isset($data->features) ? implode("\n", $data->features) : '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Chatbot</button>
        <a href="{{ route('admin.whatsapp.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
