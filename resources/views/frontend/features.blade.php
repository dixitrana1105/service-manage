@extends('frontend.layouts.main')

@section('main-container')
    <section class="service_section layout_padding" style="background-color: #d4fcd4; padding: 100px 0;">
        <div class="container">
            <div class="heading_container heading_center" data-aos="fade-down">
                <h2 style="color: #28a745;">Our Features</h2>
                <p style="margin-bottom: 40px;">Explore the powerful features our WhatsApp solution provides.</p>
            </div>

            <div class="row">
                @foreach($features as $feature)
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="feature-card text-center p-4"
                            style="background-color: #fff; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                            <div class="mb-3">
                                @if($feature->icon)
                                    <i class="{{ $feature->icon }}"
                                        style="font-size: 40px; color: {{ $feature->color ?? 'blue' }};"></i>
                                @elseif($feature->image)
                                    <img src="{{ asset($feature->image) }}" alt="Feature Image"
                                        style="width: 100px; height: 100px; object-fit: contain;">
                                @endif
                            </div>
                            <h5 class="mb-2" style="margin-top: 20px;">{{ $feature->title }}</h5>
                            <p>{{ $feature->description }}</p>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="{{ route('frontend.feature-detail', $feature->id) }}"
                                    class="btn btn-outline-success">View</a>

                                @if($feature->redirect_url)
                                    <a href="{{ $feature->redirect_url }}" class="btn btn-primary" target="_blank">Book Now</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection