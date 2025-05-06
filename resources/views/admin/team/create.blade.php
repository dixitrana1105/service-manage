@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2><i class="fas fa-user-plus me-2 text-success"></i> Add New Team Member</h2>
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Team List
        </a>
    </div>

    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name"><i class="fas fa-user me-1 text-primary"></i> Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Designation -->
            <div class="col-md-6 mb-3">
                <label for="designation"><i class="fas fa-briefcase me-1 text-info"></i> Designation</label>
                <input type="text" name="designation" id="designation" class="form-control" required>
            </div>

            <!-- Image -->
            <div class="col-md-6 mb-3">
                <label for="image"><i class="fas fa-image me-1 text-success"></i> Team Image</label>
                <input type="file" name="image" id="image" class="form-control" required onchange="previewImage(event)">
                <!-- <img id="preview" class="img-thumbnail mt-2 d-none" style="max-width: 150px;" alt="Image Preview"> -->
                <!-- Preview Image -->
                <div class="mt-3 text-center">
                    <img id="preview" src="#" alt="Image Preview" style="max-width: 150px; display: none;"
                        class="img-thumbnail shadow-sm rounded">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Social Media Fields -->
            @php
                $socials = [
                    'facebook' => 'fab fa-facebook-f',
                    'twitter' => 'fab fa-twitter',
                    'linkedin' => 'fab fa-linkedin-in',
                    'instagram' => 'fab fa-instagram',
                    'youtube' => 'fab fa-youtube',
                ];
            @endphp

            @foreach ($socials as $platform => $icon)
                <div class="col-md-6 mb-3">
                    <label for="{{ $platform }}">
                        <i class="{{ $icon }} me-1 text-secondary"></i> {{ ucfirst($platform) }} Link
                    </label>
                    <input type="url" name="{{ $platform }}" id="{{ $platform }}" class="form-control">
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-1"></i> Save Team Member
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
