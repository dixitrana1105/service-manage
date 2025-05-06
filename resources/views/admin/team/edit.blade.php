@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
        <h2><i class="fas fa-user-edit me-2 text-warning"></i> Edit Team Member</h2>
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Team List
        </a>
    </div>

    <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Name -->
            <div class="col-md-6 mb-3">
                <label for="name"><i class="fas fa-user me-1 text-primary"></i> Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $team->name) }}" required>
            </div>

            <!-- Designation -->
            <div class="col-md-6 mb-3">
                <label for="designation"><i class="fas fa-briefcase me-1 text-info"></i> Designation</label>
                <input type="text" name="designation" id="designation" class="form-control"
                       value="{{ old('designation', $team->designation) }}" required>
            </div>

            <!-- Image Upload -->
            <div class="col-md-6 mb-3">
                <label for="image"><i class="fas fa-image me-1 text-success"></i> Team Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($team->image)
                    <img src="{{ asset($team->image) }}" alt="team-image"
                         class="img-thumbnail mt-2" style="max-width: 150px;">
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Social Media Links -->
            @php
                $socials = [
                    'facebook' => 'fab fa-facebook-f',
                    'twitter' => 'fab fa-twitter',
                    'linkedin' => 'fab fa-linkedin-in',
                    'instagram' => 'fab fa-instagram',
                    'youtube' => 'fab fa-youtube',
                ];
            @endphp

            @foreach ($socials as $name => $icon)
                <div class="col-md-6 mb-3">
                    <label for="{{ $name }}">
                        <i class="{{ $icon }} me-1 text-secondary"></i> {{ ucfirst($name) }} Link
                    </label>
                    <input type="url" name="{{ $name }}" id="{{ $name }}" class="form-control"
                           value="{{ old($name, $team->$name) }}">
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-save me-1"></i> Update Team Member
            </button>
        </div>
    </form>
</div>
@endsection
