{{-- resources/views/admin/company_growth/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Add Company Growth Data')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>&nbsp; Add Company Growth Record
                        </h4>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.company_growth.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="year" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-1"></i>&nbsp;Year
                                </label>
                                <input type="number" name="year" id="year" class="form-control form-control-lg" required
                                    placeholder="Enter year (e.g. 2024)">
                            </div>

                            <div class="mb-3">
                                <label for="revenue" class="form-label fw-semibold">
                                    <i class="fas fa-dollar-sign me-1"></i>Revenue (in Millions)
                                </label>
                                <input type="number" step="0.01" name="revenue" id="revenue"
                                    class="form-control form-control-lg" required placeholder="Enter revenue">
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success btn-lg w-50 me-2">
                                    <i class="fas fa-save me-1"></i> Add Data
                                </button>&nbsp;
                                <a href="{{ route('admin.company_growth.index') }}" class="btn btn-secondary btn-lg w-50">
                                    <i class="fas fa-arrow-left me-1"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection