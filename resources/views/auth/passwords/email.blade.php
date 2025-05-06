@extends('frontend.layouts.main')

@section('main-container')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center fs-4">
                        <i class="fa-solid fa-envelope me-2"></i>{{ __('Reset Password') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Email Address') }}
                                </label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary fw-bold">
                                        <i class="fa-solid fa-paper-plane me-1"></i>{{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection