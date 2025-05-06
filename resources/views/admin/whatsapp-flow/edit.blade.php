@extends('admin.layouts.app')

@section('content')
    <div class="container pt-4">
        <h2 class="mb-4"><i class="fab fa-whatsapp text-success me-2">&nbsp;</i>Manage Interactive WhatsApp Flows</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.whatsapp-flow.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label>Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required
                    value="{{ old('title', $flow->title ?? '') }}">
            </div>

            <div class="mb-4">
                <label>Subtitle <span class="text-danger">*</span></label>
                <input type="text" name="subtitle" class="form-control" required
                    value="{{ old('subtitle', $flow->subtitle ?? '') }}">
            </div>

            <div class="mb-4">
                <label>Image</label><br>
                @if(!empty($flow->image))
                    <img src="{{ asset('uploads/whatsapp-flows/' . $flow->image) }}" width="120" class="mb-2"><br>
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <hr class="my-5">
            <h5>Features <span class="text-danger">*</span></h5>

            <div id="features-wrapper">
                @php
                    $features = old('features') ?? json_decode($flow->features ?? '[]', true);
                @endphp

                @foreach($features as $i => $feature)
                    <div class="border rounded p-3 mb-4 feature-group">
                        <div class="mb-3">
                            <label>
                                Feature Icon Class <span class="text-danger">*</span>
                                <span class="color-square ms-2"
                                    style="display: {{ empty($feature['icon']) ? 'none' : 'inline-block' }}; width: 16px; height: 16px; border: 1px solid #ccc; border-radius: 3px; cursor: pointer; background-color: {{ $feature['color'] ?? '#000000' }};"
                                    onclick="this.nextElementSibling.click()"></span>
                                <input type="color" name="features[{{ $i }}][color]" class="d-none color-input"
                                    value="{{ $feature['color'] ?? '#000000' }}">
                            </label>
                            <input type="text" name="features[{{ $i }}][icon]" class="form-control icon-input"
                                value="{{ $feature['icon'] ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Feature Name <span class="text-danger">*</span></label>
                            <input type="text" name="features[{{ $i }}][name]" class="form-control"
                                value="{{ $feature['name'] ?? '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Feature Description <span class="text-danger">*</span></label>
                            <textarea name="features[{{ $i }}][description]" rows="3" class="form-control"
                                required>{{ $feature['description'] ?? '' }}</textarea>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-secondary mt-3" id="add-feature">+ Add Feature</button>
            <button type="submit" class="btn btn-primary float-end mt-3">Update</button>
        </form>
    </div>

    <script>
        function updateColorSquareVisibility(input) {
            const square = input.closest('.mb-3').querySelector('.color-square');
            if (square) {
                square.style.display = input.value.trim() ? 'inline-block' : 'none';
            }
        }

        // Initial setup for existing icon inputs
        document.querySelectorAll('.icon-input').forEach(input => {
            input.addEventListener('input', () => updateColorSquareVisibility(input));
        });

        // Update square background on color input change
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('color-input')) {
                const square = e.target.previousElementSibling;
                if (square) {
                    square.style.backgroundColor = e.target.value;
                }
            }
        });

        let index = {{ count($features) }};
        document.getElementById('add-feature').addEventListener('click', function () {
            const wrapper = document.getElementById('features-wrapper');
            const div = document.createElement('div');
            div.classList.add('border', 'rounded', 'p-3', 'mb-4', 'feature-group');
            div.innerHTML = `
                <div class="mb-3">
                    <label>
                        Feature Icon Class <span class="text-danger">*</span>
                        <span class="color-square ms-2"
                              style="display: none; width: 16px; height: 16px; border: 1px solid #ccc; border-radius: 3px; cursor: pointer; background-color: #000000;"
                              onclick="this.nextElementSibling.click()"></span>
                        <input type="color" name="features[${index}][color]" class="d-none color-input" value="#000000">
                    </label>
                    <input type="text" name="features[${index}][icon]" class="form-control icon-input" required>
                </div>
                <div class="mb-3">
                    <label>Feature Name <span class="text-danger">*</span></label>
                    <input type="text" name="features[${index}][name]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Feature Description <span class="text-danger">*</span></label>
                    <textarea name="features[${index}][description]" rows="3" class="form-control" required></textarea>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-feature">Remove</button>
            `;
            wrapper.appendChild(div);

            // Attach listener to the new icon input
            const newIconInput = div.querySelector('.icon-input');
            newIconInput.addEventListener('input', () => updateColorSquareVisibility(newIconInput));

            index++;
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.feature-group').remove();
            }
        });
    </script>
@endsection