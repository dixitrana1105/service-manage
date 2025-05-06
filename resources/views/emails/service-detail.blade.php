@extends('frontend.layouts.main')

@section('main-container')

<!-- AOS CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<!-- Custom CSS for Service Details -->
<link href="{{ asset('assets/frontend-2/css/service-details.css') }}" rel="stylesheet">


<!--<style>
    .service-wrapper {
        padding: 60px 15px;
        background: linear-gradient(135deg, #f3fff3 0%, #ffffff 100%);
    }

    .page-title {
        text-align: center;
        font-size: 3rem;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 70px;
        position: relative;
    }

    .page-title::after {
        content: '';
        display: block;
        width: 100px;
        height: 4px;
        background: #28a745;
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .section-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-bottom: 50px;
        transition: all 0.3s ease;
    }

    .section-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .section-img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .section-content {
        padding: 30px;
    }

    .section-content h4 {
        font-size: 2rem;
        font-weight: 600;
        color: #1ce25e;
        margin-bottom: 20px;
        text-align: center;
    }

    .section-content p {
    font-size: 2rem !important;
    color: #555;
    line-height: 1.8;
    font-family: 'Roboto', sans-serif !important;



    .flex-fill-height {
        min-height: 300px;
    }

    @media (max-width: 767px) {
        .section-content {
            text-align: center;
        }
    }
</style>-->

<div class="service-wrapper container">
    <h2 class="page-title">{{ $service->title }}</h2>

    @if($sections->count())
        @foreach($sections as $index => $section)
            @php
                $position = strtolower(str_replace(' ', '-', $section->image_position));
                $isCenterLayout = str_starts_with($position, 'center');
                $isTop = str_ends_with($position, 'top');
                $isDown = str_ends_with($position, 'down');
                $alignClass = $isTop ? 'align-items-start' : ($isDown ? 'align-items-end' : 'align-items-center');
                $orderClass = str_contains($position, 'left') ? 'flex-row' : 'flex-row-reverse';
            @endphp

            <div class="section-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                @if($isCenterLayout)
                    {{-- Centered layout (stacked) --}}
                    <div class="d-flex flex-column {{ $alignClass }} text-center flex-fill-height">
                        @if($section->image)
                            <div class="p-3 w-100 d-flex justify-content-center">
                                <img src="{{ asset($section->image) }}" alt="{{ $section->title }}" class="section-img">
                            </div>
                        @endif
                        <div class="w-100">
                            <div class="section-content">
                                <h4>{{ $section->title }}</h4>
                                <p>{!! $section->description !!}</p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Left or Right layout --}}
                    <div class="row g-0 d-flex {{ $orderClass }} {{ $alignClass }} flex-fill-height">
                        @if($section->image)
                            <div class="col-md-6 d-flex justify-content-center {{ $alignClass }} flex-fill-height">
                                <img src="{{ asset($section->image) }}" alt="{{ $section->title }}" class="section-img">
                            </div>
                        @endif
                        <div class="col-md-6 d-flex {{ $alignClass }} flex-fill-height">
                            <div class="section-content">
                                <h4>{{ $section->title }}</h4>
                                @if($section->description_type === 'bullet')
    <ul>
        @foreach(explode("\n", $section->description) as $line)
            @if(trim($line) !== '')
                <li>{{ trim($line) }}</li>
            @endif
        @endforeach
    </ul>
@elseif($section->description_type === 'numbered')
    <ol>
        @foreach(explode("\n", $section->description) as $line)
            @if(trim($line) !== '')
                <li>{{ trim($line) }}</li>
            @endif
        @endforeach
    </ol>
@else
    <p>{!! $section->description !!}</p>
@endif

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p class="text-center">No detail sections available for this service.</p>
    @endif
</div>

<!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>

@endsection
