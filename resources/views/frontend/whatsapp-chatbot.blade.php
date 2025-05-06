@extends('frontend.layouts.main')

@section('main-container')
    <div class="container mt-5"
        style="background-color: #d4fcd4; padding: 50px; border-radius: 15px; box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.05);"
        data-aos="fade-up" data-aos-duration="1000">
        @foreach ($chatbots as $chatbot)
            @if($chatbot)
                <!-- Title -->
                <h2 class="text-center mb-3" style="color: #006400; font-weight: 700;" data-aos="fade-down"
                    data-aos-duration="1000">
                    {{ $chatbot->title }}
                </h2>

                <!-- Description -->
                <p class="text-center mb-4" style="color: #333; font-size: 18px;" data-aos="fade-up" data-aos-duration="1200">
                    {{ $chatbot->description }}
                </p>

                <!-- Image -->
                <div class="text-center mb-5" data-aos="zoom-in" data-aos-duration="1500">
                    @if($chatbot->image)
                        <img src="{{ asset($chatbot->image) }}" alt="WhatsApp Chatbot" class="img-fluid rounded-4 shadow-lg"
                            style="max-width: 350px;">
                    @endif
                </div>

                <!-- Features Section -->
                <div class="mt-4" data-aos="fade-up" data-aos-duration="1500">
                    <h4 class="text-center" style="color: #006400; font-weight: 600; font-size: 28px;">Features:</h4>
                    <div class="row mt-4">
                        @foreach($chatbot->feature_titles ?? [] as $index => $title)
                            <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="feature-box p-4 text-center bg-white rounded-3 shadow-sm h-100">
                                    @if(!empty($chatbot->feature_icons[$index]))
                                        <i class="fas {{ $chatbot->feature_icons[$index] }} fa-2x mb-3" style="color: #006400;"></i>
                                    @endif
                                    <h5 class="mb-2" style="color: #006400;">{{ $title }}</h5>
                                    <p style="font-size: 16px; color: #333;">
                                        {{ $chatbot->feature_descriptions[$index] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @else
                <p class="text-center" data-aos="fade-up" data-aos-duration="1000">
                    WhatsApp Chatbot information will be available soon.
                </p>
            @endif
        @endforeach

    </div>
@endsection