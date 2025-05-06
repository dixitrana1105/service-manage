@extends('frontend.layouts.main')

@section('main-container')
    <div class="container mt-5" style="background-color: #d4fcd4; padding: 50px; border-radius: 15px; box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);" data-aos="fade-up" data-aos-duration="1000">
        @if($data)
            <!-- Title -->
            <h2 class="text-center" style="color: #006400; font-size: 36px; font-weight: 700;" data-aos="fade-down" data-aos-duration="1000">{{ $data->title }}</h2>

            <!-- Description -->
            <p class="text-center" style="color: #333; font-size: 18px; line-height: 1.6;" data-aos="fade-up" data-aos-duration="1200">{{ $data->description }}</p>

            <!-- Image -->
            <div class="text-center" data-aos="fade-left" data-aos-duration="1500">
                @if($data->image)
                    <img src="{{ asset($data->image) }}" alt="Business Automation" class="img-fluid rounded-4 shadow-lg" style="max-width: 350px; margin-top: 20px;">
                @endif
            </div>

            <!-- Key Benefits -->
            <div class="mt-5" data-aos="fade-up" data-aos-duration="1200">
                <h4 style="color: #006400; font-size: 28px; font-weight: 600; text-align: center;">Key Benefits:</h4>
                <ul class="list-unstyled" style="font-size: 18px; color: #333; padding-left: 30px;">
                    @if(is_array($data->benefits))
                        @foreach($data->benefits as $benefit)
                            <li>{!! $benefit !!}</li>
                        @endforeach
                    @else
                        <li>No benefits available.</li>
                    @endif
                </ul>
            </div>
            
        @else
            <p class="text-center" style="font-size: 18px; color: #333;">No Business Automation data available.</p>
        @endif
    </div>
@endsection
