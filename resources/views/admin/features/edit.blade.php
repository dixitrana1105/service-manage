@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Feature</h2>
        <form action="{{ route('admin.features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>
                    Feature Icon (e.g. fa-solid fa-robot)
                </label>
                <div class="d-flex align-items-center">
                    <input type="text" name="icon" class="form-control icon-input"
                        value="{{ old('icon', $feature->icon) }}">
                    <span class="color-square ms-2"
                        style="display: {{ $feature->icon ? 'inline-block' : 'none' }}; width: 24px; height: 24px; border: 1px solid #ccc; border-radius: 3px; cursor: pointer; background-color: {{ old('color', $feature->color ?? '#000000') }};"
                        onclick="this.nextElementSibling.click()"></span>
                    <input type="color" name="color" class="d-none color-input"
                        value="{{ old('color', $feature->color ?? '#000000') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Feature Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $feature->title) }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Feature Description</label>
                <textarea name="description" class="form-control"
                    rows="4">{{ old('description', $feature->description) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Feature Image</label><br>
                @if($feature->image)
                    <img src="{{ asset($feature->image) }}" width="100" class="mb-2">
                @endif
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Feature</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const iconInput = document.querySelector('.icon-input');
            const colorInput = document.querySelector('.color-input');
            const colorSquare = document.querySelector('.color-square');

            // Show color square if icon is not empty
            function updateColorSquareVisibility() {
                if (iconInput.value.trim() !== '') {
                    colorSquare.style.display = 'inline-block';
                } else {
                    colorSquare.style.display = 'none';
                }
            }

            // Update square color on color change
            colorInput.addEventListener('input', function () {
                colorSquare.style.backgroundColor = this.value;
            });

            // Handle icon typing
            iconInput.addEventListener('input', updateColorSquareVisibility);

            // Initial call
            updateColorSquareVisibility();
        });
    </script>
@endsection