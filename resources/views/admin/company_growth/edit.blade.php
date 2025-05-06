{{-- resources/views/admin/company_growth/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Company Growth')

@section('content')
    <div class="container">
        <div class="container mb-4 mt-4">
            <h2 class="mb-4">Edit Company Growth Record</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form class="col mb-4" action="{{ route('admin.company_growth.update', $companyGrowth->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" name="year" id="year" class="form-control"
                        value="{{ old('year', $companyGrowth->year) }}" required>
                </div>

                <div class="mb-3">
                    <label for="revenue" class="form-label">Revenue (in Millions)</label>
                    <input type="number" step="0.01" name="revenue" id="revenue" class="form-control"
                        value="{{ old('revenue', $companyGrowth->revenue) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.company_growth.index') }}" class="btn btn-secondary">Cancel</a>
            </form>

        </div>

    </div>
@endsection