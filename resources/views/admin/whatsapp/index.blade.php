@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Title with Icon -->
        <div class="d-flex align-items-center mb-3">
            <i style="color: green;" class="fab fa-whatsapp fa-2x text-success me-4"></i>&nbsp;
            <h2 class="mb-0">&nbsp;Manage WhatsApp Chatbot</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.whatsapp.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $data->title ?? '') }}" class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" rows="4" class="form-control"
                    required>{{ old('description', $data->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Image</label><br>
                @if(!empty($data->image))
                    <img src="{{ asset($data->image) }}" width="100" class="mb-2"><br>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
            </div>

            <hr>
            <h5 class="mb-3">Features</h5>

            <div id="features-wrapper">
                @php
                    $titles = $data->feature_titles ?? [];
                    $icons = $data->feature_icons ?? [];
                    $descriptions = $data->feature_descriptions ?? [];
                @endphp

                @foreach($titles as $index => $title)
                    <div class="feature-group border rounded p-3 mb-3">
                        <div class="mb-2">
                            <label>Feature Title</label>
                            <input type="text" name="feature_titles[]" class="form-control" value="{{ $title }}" required>
                        </div>

                        <div class="mb-2">
                            <label>Feature Icon (Font Awesome class)</label>
                            <input type="text" name="feature_icons[]" class="form-control" value="{{ $icons[$index] ?? '' }}"
                                required>
                        </div>

                        <div class="mb-2">
                            <label>Feature Description</label>
                            <textarea name="feature_descriptions[]" class="form-control" rows="3"
                                required>{{ $descriptions[$index] ?? '' }}</textarea>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm remove-feature mt-2">Remove</button>
                    </div>
                @endforeach
            </div>

            <!-- Buttons Row -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button type="button" class="btn btn-secondary" id="add-feature">+ Add Feature</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }

        document.getElementById('add-feature').addEventListener('click', function () {
            const wrapper = document.getElementById('features-wrapper');
            const div = document.createElement('div');
            div.classList.add('feature-group', 'border', 'rounded', 'p-3', 'mb-3');
            div.innerHTML = `
                    <div class="mb-2">
                        <label>Feature Title</label>
                        <input type="text" name="feature_titles[]" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Feature Icon (Font Awesome class)</label>
                        <input type="text" name="feature_icons[]" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Feature Description</label>
                        <textarea name="feature_descriptions[]" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="button" class="btn btn-danger btn-sm remove-feature mt-2">Remove</button>
                `;
            wrapper.appendChild(div);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.feature-group').remove();
            }
        });
    </script>
@endsection