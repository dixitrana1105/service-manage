@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="pt-4"></div>

        <div class="d-flex align-items-center mb-4">
            <i class="fab fa-whatsapp fa-2x text-success me-3"></i>&nbsp;&nbsp;
            <h2 class="mb-0">Manage WhatsApp Live Preview</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('whatsapp-preview.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $preview->title ?? '') }}"
                    class="form-control" required>
            </div>

            <!-- Header Text -->
            <div class="mb-4">
                <label for="header_text" class="form-label">Header Text <span class="text-danger">*</span></label>
                <input type="text" name="header_text" id="header_text"
                    value="{{ old('header_text', $preview->header_text ?? '') }}" class="form-control" required>
            </div>

            <!-- Icon Image -->
            <div class="mb-4">
                <label for="icon_image" class="form-label">Icon Image</label><br>
                @if($preview && $preview->icon_image)
                    <img src="{{ asset($preview->icon_image) }}" alt="Current Icon" width="100" class="mb-2 rounded">
                @endif
                <input type="file" name="icon_image" id="icon_image" class="form-control">
            </div>

            <!-- Video Upload -->
            <div class="mb-5">
                <label for="video" class="form-label">Video</label><br>
                @if($preview && $preview->video)
                    <video width="200" controls class="mb-2 d-block">
                        <source src="{{ asset($preview->video) }}" type="video/mp4">
                    </video>
                @endif
                <input type="file" name="video" id="video" class="form-control">
            </div>

            <!-- Chat Messages -->
            <h5 class="mb-3">Chat Messages <span class="text-danger">*</span></h5>
            <div id="chat-messages-wrapper">
                @php
                    $chatMessages = old('chat_messages', $preview->chat_messages ?? [['type' => 'user', 'message' => '']]);
                @endphp

                @foreach ($chatMessages as $index => $message)
                    <div class="chat-row border rounded p-3 mb-3 d-flex align-items-center">
                        <select name="chat_messages[{{ $index }}][type]" class="form-control me-2" style="width: 120px;">
                            <option value="user" {{ $message['type'] === 'user' ? 'selected' : '' }}>User</option>
                            <option value="bot" {{ $message['type'] === 'bot' ? 'selected' : '' }}>Bot</option>
                        </select>
                        <input type="text" name="chat_messages[{{ $index }}][message]" class="form-control me-2"
                            value="{{ $message['message'] ?? '' }}" required>
                        <button type="button" class="btn btn-danger remove-row">×</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-message">+ Add Message</button>

            <!-- Submit Button -->
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">Update Preview</button>
            </div>

            <div class="pb-5"></div>
        </form>
    </div>

    {{-- JavaScript for dynamic chat messages --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let index = {{ count($chatMessages) }};

            document.getElementById('add-message').addEventListener('click', function () {
                const wrapper = document.getElementById('chat-messages-wrapper');

                const row = document.createElement('div');
                row.classList.add('chat-row', 'border', 'rounded', 'p-3', 'mb-3', 'd-flex', 'align-items-center');
                row.innerHTML = `
                            <select name="chat_messages[${index}][type]" class="form-control me-2" style="width: 120px;">
                                <option value="user">User</option>
                                <option value="bot">Bot</option>
                            </select>
                            <input type="text" name="chat_messages[${index}][message]" class="form-control me-2" required>
                            <button type="button" class="btn btn-danger remove-row">×</button>
                        `;

                wrapper.appendChild(row);
                index++;
            });

            document.getElementById('chat-messages-wrapper').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.chat-row').remove();
                }
            });
        });
    </script>
@endsection