@extends('frontend.layouts.main')

@section('main-container')
    <!-- <div class="container mt-5">
                    <h3 class="mb-4"><i class="bi bi-megaphone-fill text-primary"></i>&nbsp; Latest Broadcasts</h3>

                    @if($broadcasts->isEmpty())
                        <div class="alert alert-info">No broadcasts available.</div>
                    @else
                        <ul class="list-group">
                            @foreach ($broadcasts as $broadcast)
                                <li class="list-group-item">
                                    <h5 class="mb-1 text-dark">
                                        <i class="bi bi-broadcast-pin text-success"></i>&nbsp;
                                       <label for="title" style="font-family: 'Times New Roman', Times, serif;">Title :</label> {{ $broadcast->title }}
                                    </h5>
                                    <p class="mb-0"><label for="message" style="font-family: 'Times New Roman', Times, serif;">Message :</label>&nbsp;{{ $broadcast->message }}</p>
                                    <small class="text-muted"><i class="bi bi-calendar-event"></i>&nbsp;
                                        {{ $broadcast->created_at->format('d M Y') }}</small>
                                </li><hr>
                            @endforeach
                        </ul>
                    @endif
                </div> -->
    <section class="section" style="background-color: #d4fcd4; padding: 60px 0;" data-aos="zoom-in"
        style="padding-top: 100px; padding-bottom: 100px;">
        <div class="container">
            <h2 class="mb-5 text-center" style="font-weight: bold; font-size: 32px;">
                <i class="bi bi-megaphone-fill text-primary"></i>&nbsp;
                Latest Broadcasts
            </h2>
            <strong class="text-mute">Boost customer engagement and streamline communication with
                our advanced WhatsApp chatbot solutions – automate responses, support faster, and stay connected
                24/7!</strong>
            <hr>

            @if($broadcasts->isEmpty())
                <div class="alert alert-info">No broadcasts available.</div>
            @else
                <!-- <div class="row g-4">
                            @foreach ($broadcasts as $broadcast)
                                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                                    <div class="feature-card text-center p-4 bg-white shadow rounded">
                                        <h4 class="fw-bold mb-2" style="font-family: 'Times New Roman', Times, serif;">Title
                                            :{{ $broadcast->title }}</h4>
                                        <p>{{ $broadcast->message }}</p>
                                        <small class="text-muted"><i class="bi bi-calendar-event"></i>
                                            <strong class="text-mute"><a
                                                    href="{{ route('broadcasts.byDate', ['date' => $broadcast->created_at->format('Y-m-d')]) }}"
                                                    target="_blank" rel="noopener noreferrer">
                                                    {{ $broadcast->created_at->format('d M Y') }}
                                                </a></strong></small>
                                    </div>
                                </div>
                            @endforeach
                        </div> -->
                <div class="row g-4 justify-content-center">
                    @foreach ($broadcasts as $broadcast)
                        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                            <div class="feature-card text-center p-4 bg-white shadow rounded h-100">
                                <h4 class="fw-bold mb-2" style="font-family: 'Times New Roman', Times, serif;">
                                    Title: {{ $broadcast->title }}
                                </h4><hr>
                                <p>{!! $broadcast->message  !!}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event"></i>
                                    <strong>
                                        <a href="{{ route('broadcasts.byDate', ['date' => $broadcast->created_at->format('Y-m-d')]) }}"
                                            target="_blank" rel="noopener noreferrer" class="text-muted text-decoration-primary">
                                            {{ $broadcast->created_at->format('d M Y') }}
                                        </a>
                                    </strong>
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </section>
@endsection