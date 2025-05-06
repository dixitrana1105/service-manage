{{-- resources/views/admin/company_growth/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Company Growth Data')

@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="fw-bold text-primary">Company Growth Data</h1>
                <p class="text-secondary mt-2" id="currentDateTime">
                    {{ now()->format('l, F j, Y - h:i A') }}
                </p>
            </div>
        </div>

        <!-- Top Bar with Icon and Add Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="d-flex align-items-center">
                <i class="fas fa-chart-line bg-white text-dark rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                    style="width: 30px; height: 30px; font-size: 16px;"></i>
                <span>Company Growth List</span>
            </h2>
            <a href="{{ route('admin.company_growth.create') }}" class="btn btn-success">+ Add Growth Data</a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table Section -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm text-center align-middle" style="font-size: 12px;">

                <div class="table-responsive position-relative watermark-container" >
                    <table class="table table-bordered table-hover table-sm text-center align-middle"
                        style="font-size: 14px;">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Year</th>
                                <th style="width: 30%;">Revenue (in Millions)</th>
                                <th style="width: 25%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($growths as $key => $growth)
                                <tr style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $growth->year }}</td>
                                    <td>&#8377;{{ number_format($growth->revenue, 2) }}</td>
                                    <td>
                                        <a href="{{ route('admin.company_growth.edit', $growth->id) }}"
                                            class="btn btn-sm btn-primary me-1">Edit</a>
                                        <form action="{{ route('admin.company_growth.destroy', $growth->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">No data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </table>
        </div>
    </div>
@endsection