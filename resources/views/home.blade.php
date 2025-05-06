{{-- resources/views/home.blade.php --}}

@extends('frontend.layouts.main')

@section('main-container')

    {{-- Home Banner --}}
@foreach ($banner as $baners)
    @if (!empty($baners))
        <section class="hero-section" style="background-image: url('{{ asset($baners->image) }}'); background-size: cover; background-position: center;">
            <div class="container text-white text-center py-5">
                <div class="banner-content" style="max-width: 100%; height: 400px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <h1>{{ $baners->title }}</h1>
                    <p>{{ $baners->subtitle }}</p>
                </div>
            </div>
        </section>
    @else
        <div class="alert alert-warning text-center my-4">
            Banner not available.
        </div>
    @endif
@endforeach

        
    {{-- Other content --}}
    <div class="container mt-5">
        <h2 style=" color: white;">Welcome to our website</h2>
    </div>

@endsection
