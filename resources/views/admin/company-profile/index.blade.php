<!-- resources/views/admin/company-profile/index.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 mt-4"><i class="fas fa-building"></i> Company Profile</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.company-profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Company Name -->
                <div class="col-md-6 mb-3">
                    <label for="company_name" class="form-label">
                        <i class="fas fa-building"></i> Company Name
                    </label>
                    <input type="text" name="company_name" id="company_name" class="form-control"
                        value="{{ old('company_name', $companyProfile->company_name ?? '') }}" required>
                </div>

                <!-- Company Tagline -->
                <div class="col-md-6 mb-3">
                    <label for="company_tagline" class="form-label">
                        <i class="fas fa-quote-left"></i> Company Tagline
                    </label>
                    <input type="text" name="company_tagline" id="company_tagline" class="form-control"
                        value="{{ old('company_tagline', $companyProfile->company_tagline ?? '') }}">
                </div>
            </div>

            <div class="row">
                <!-- Company Logo -->
                <div class="col-md-6 mb-3">
                    <label for="company_logo" class="form-label">
                        <i class="fas fa-image"></i> Company Logo
                    </label>
                    <input type="file" name="company_logo" id="company_logo" class="form-control">
                    @if($companyProfile->company_logo)
                        <img src="{{ asset($companyProfile->company_logo) }}" width="100" alt="Company Logo">
                    @else
                        <p>No Logo Available</p>
                    @endif
                </div>

                <!-- Website URL -->
                <div class="col-md-6 mb-3">
                    <label for="website_url" class="form-label">
                        <i class="fas fa-globe"></i> Website URL
                    </label>
                    <input type="url" name="website_url" id="website_url" class="form-control"
                        value="{{ old('website_url', $companyProfile->website_url ?? '') }}">
                </div>
            </div>

            <div class="row">
                <!-- Industry Type -->
                <div class="col-md-6 mb-3">
                    <label for="industry_type" class="form-label">
                        <i class="fas fa-industry"></i> Industry Type
                    </label>
                    <input type="text" name="industry_type" id="industry_type" class="form-control"
                        value="{{ old('industry_type', $companyProfile->industry_type ?? '') }}">
                </div>

                <!-- Phone Number -->
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">
                        <i class="fas fa-phone"></i> Phone Number
                    </label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                        value="{{ old('phone_number', $companyProfile->phone_number ?? '') }}">
                </div>
            </div>

            <div class="row">
                <!-- Company Description -->
                <div class="col-md-6 mb-3">
                    <label for="company_description" class="form-label">
                        <i class="fas fa-align-left"></i> Company Description
                    </label>
                    <textarea name="company_description" id="company_description" class="form-control"
                        rows="4">{{ old('company_description', $companyProfile->company_description ?? '') }}</textarea>
                </div>

                <!-- Email Address -->
                <div class="col-md-6 mb-3">
                    <label for="email_address" class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input type="email" name="email_address" id="email_address" class="form-control"
                        value="{{ old('email_address', $companyProfile->email_address ?? '') }}">
                </div>
            </div>

            <div class="row">
                <!-- Fax Number -->
                <div class="col-md-6 mb-3">
                    <label for="fax_number" class="form-label">
                        <i class="fas fa-fax"></i> Fax Number
                    </label>
                    <input type="text" name="fax_number" id="fax_number" class="form-control"
                        value="{{ old('fax_number', $companyProfile->fax_number ?? '') }}">
                </div>

                <!-- Office Address -->
                <div class="col-md-6 mb-3">
                    <label for="office_address" class="form-label">
                        <i class="fas fa-map-marker-alt"></i> Office Address
                    </label>
                    <input type="text" name="office_address" id="office_address" class="form-control"
                        value="{{ old('office_address', $companyProfile->office_address ?? '') }}">
                </div>
            </div>

            <div class="row">
                <!-- Social Media Links -->
                <div class="col-md-6 mb-4">
                    <label for="social_media_links" class="form-label">
                        <i class="fab fa-facebook-f"></i> <i class="fab fa-twitter"></i> Social Media Links
                    </label>
                    <input type="text" name="social_media_links" id="social_media_links" class="form-control"
                        value="{{ old('social_media_links', $companyProfile->social_media_links ?? '') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Profile
            </button>
        </form>
    </div>
@endsection