@extends('frontend.layouts.main')

@section('main-container')
    <section class="section bg-light py-5" data-aos="zoom-in">
        <div class="container">
            <h2 class="mb-5 text-center fw-bold fs-2">
                <i class="bi bi-calendar-event"></i>&nbsp;
                Broadcasts on {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
            </h2>

            @if($broadcasts->isEmpty())
                <div class="alert alert-info text-center">No broadcasts found for this date.</div>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach ($broadcasts as $broadcast)
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-header bg-white text-center fw-bold">
                                    <i class="bi bi-calendar-event text-primary"></i>&nbsp;
                                    {{ $broadcast->created_at->format('d M Y') }}
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-primary">{{ $broadcast->title }}</h5>
                                    <p class="card-text">
                                        {!! $broadcast->message !!}
                                    </p>
                                </div>

                                <div class="card-footer bg-transparent text-center text-muted small">
                                    <i class="bi bi-megaphone-fill text-primary"></i>&nbsp;
                                    {{ $broadcast->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection