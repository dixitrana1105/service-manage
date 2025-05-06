@extends('frontend.layouts.main')

@section('main-container')

    <section class="service_section layout_padding"
        style="background-color: #d4fcd4; padding-top: 100px; padding-bottom: 100px;">
        <div class="service_container">
            <div class="container">
                <div class="heading_container heading_center" data-aos="fade-down" data-aos-duration="1000">
                    <h2 style="font-size: 32px; font-weight: bold;">
                        <span style="color: #28a745;">Our Services</span>
                    </h2>
                    <p style="font-size: 18px;">
                        Enhance customer engagement and automate responses with our powerful WhatsApp chatbot solutions.
                    </p>
                </div>
                <div class="row">
                    @foreach($services as $service)
                        <div class="col-md-4" data-aos="fade-up" data-aos-duration="1200">
                            <div class="box"
                                style="background: #fff; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="img-box" style="margin-bottom: 15px;">
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}"
                                        style="max-width: 100px;">
                                </div>
                                <div class="detail-box">
                                    <h5 style="font-size: 22px; font-weight: bold;">{{ $service->title }}</h5>
                                    <p style="font-size: 16px;">{{ $service->description }}</p>
                                    <a href="{{ route('service.show', $service->id) }}"
                                        style="font-size: 18px; font-weight: bold;">Read More</a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection