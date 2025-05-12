@extends('frontend.layouts.main')

@section('main-container')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/frontend-2/css/service-details.css') }}" rel="stylesheet">

    <div class="service-wrapper container">
        <h2 class="page-title">{{ $feature->title }}</h2>

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
                        <div class="d-flex flex-column {{ $alignClass }} text-center flex-fill-height">
                            @if($section->image)
                                <div class="p-3 w-100 d-flex justify-content-center">
                                    <img src="{{ asset($section->image) }}" alt="{{ $section->title }}" class="section-img">

                                </div>
                            @endif
                            <div class="w-100">
                                <div class="section-content">
                                    <h4>{{ $section->title }}</h4>
                                    <p>{{ $section->description }}</p>
                                </div>
                            </div>
                        </div>
                    @else
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
                                        <p>{!! nl2br(e($section->description)) !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-center">No detailed sections available for this feature.</p>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init();</script>

@endsection