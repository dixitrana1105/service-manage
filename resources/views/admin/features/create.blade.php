@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Add Feature</h2>
        <form id="featureForm" action="{{ route('admin.features.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group mb-3">
                <label>
                    Feature Icon Class (e.g. fa-solid fa-robot)
                </label>
                <div class="d-flex align-items-center">
                    <input type="text" name="icon" class="form-control icon-input" value="{{ old('icon') }}">
                    <span class="color-square ms-2"
                        style="display: {{ old('icon') ? 'inline-block' : 'none' }}; width: 24px; height: 24px; border: 1px solid #ccc; border-radius: 3px; cursor: pointer; background-color: {{ old('color', '#000000') }};"
                        onclick="this.nextElementSibling.click()"></span>
                    <input type="color" name="color" class="d-none color-input" value="{{ old('color', '#000000') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label>Feature Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="form-group mb-3">
                <label>Feature Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Feature Image</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Feature</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('featureForm');
            const iconInput = document.querySelector('input[name="icon"]');
            const imageInput = document.querySelector('input[name="image"]');

            form.addEventListener('submit', function (e) {
                const iconFilled = iconInput.value.trim() !== '';
                const imageFilled = imageInput.files.length > 0;

                if (iconFilled && imageFilled) {
                    e.preventDefault();
                    alert("Please fill either the icon or the image — not both.");
                    return false;
                }

                if (!iconFilled && !imageFilled) {
                    e.preventDefault();
                    alert("Please provide either an icon or an image.");
                    return false;
                }
            });
        });
    </script>

@endsection