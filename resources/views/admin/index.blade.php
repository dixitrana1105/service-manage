@include('frontend.layouts.header')

@section('main-container')
<style>
  @media (max-width: 768px) {
    .hero-section {
      min-height: 70vh;
      padding: 10px;
    }

    .hero-video,
    .object-fit-cover {
      object-position: center;
    }

    .section {
      padding: 20px 0;
    }

    .chat-mockup {
      max-width: 100%;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .carousel-item {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .carousel-inner {
      flex-direction: column;
    }

    .carousel-control-prev,
    .carousel-control-next {
      display: none;
    }
  }
</style>
<!-- HERO SECTION WITH VIDEO BACKGROUND -->
<section class="hero-section position-relative text-white" style="min-height: 100vh; overflow: hidden;">
  <!-- Background Video -->
  @foreach ($banner as $baners)
    @if ($baners->media_type)
    @if ($baners->media_type === 'video')
    <video autoplay muted loop playsinline class="hero-video w-100 h-100 object-fit-cover">
    <source src="{{ asset($baners->image) }}" type="video/mp4">
    Your browser does not support the video tag.
    </video>
    @else
    <img src="{{ asset($baners->image) }}" class="w-100 h-100 object-fit-cover" alt="Section Image">
    @endif
    @else
    <span class="text-muted">No Media</span>
    @endif
  @endforeach

  <!-- Overlay (for contrast) -->
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4); z-index: 1;">
  </div>

  <!-- Content on Video -->
  <div
    class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative text-center px-3"
    style="z-index: 2;">
    @foreach ($banner as $baners)
    <h1 class="display-5 fw-bold mb-3">{{ $baners->title }}</h1>
    <blockquote class="lead" style="font-family: 'Times New Roman', Times, serif; font-size: larger;">
      {!! $baners->subtitle !!}
    </blockquote>
  @endforeach

    <!-- Service Clipart Icons -->
    <div class="d-flex flex-wrap justify-content-center mt-4 gap-4">
      <!-- <img src="{{ asset('assets/frontend-2/images/service-web-dev.png') }}" alt="Web Development" width="70">
      <img src="{{ asset('assets/frontend-2/images/Webdesign.png') }}" alt="Design" width="70">
      <img src="{{ asset('assets/frontend-2/images/service-marketing.png') }}" alt="Marketing" width="70">
      <img src="{{ asset('assets/frontend-2/images/service-support.png') }}" alt="Support" width="70"> -->
    </div>
  </div>
</section>


<!-- WhatsApp Chat Mockup with Video -->
@php
  $preview = \App\Models\WhatsAppPreview::first();
@endphp

@if($preview)
  <section class="section bg-light" data-aos="zoom-in">
    <div class="container">
    <h2 class="text-center mb-5">{{ $preview->title }}</h2>
    <div class="row align-items-center">

      <!-- Left: Chat Mockup -->
      <div class="col-md-6 mb-4 mb-md-0">
      <div class="chat-mockup mx-auto">
        <div class="chat-header">
        <img src="{{ asset($preview->icon_image) }}" width="28" alt="whatsapp icon" />
        {{ $preview->header_text }}
        </div>
        <div class="chat-body">
        @foreach($preview->chat_messages as $msg)
        @if(isset($msg['message'])) <!-- Check if the 'message' key exists -->
        <div class="message {{ $msg['type'] ?? 'user' }}">{{ $msg['message'] }}</div>
        @else
        <!-- Optionally, show a default message if 'message' is missing -->
        <div class="message {{ $msg['type'] ?? 'user' }}">No message available</div>
        @endif
      @endforeach
        </div>
      </div>
      </div>

      <!-- Right: Video -->
      <div class="col-md-6">
      <div class="ratio ratio-16x9">
        <video src="{{ asset($preview->video) }}" autoplay muted controls></video>
      </div>
      </div>

    </div>
    </div>
  </section>
@endif

<!-- WhatsApp Flow Section -->
@if($flow)
  @php
    try {
    $features = is_array($flow->features) ? $flow->features : json_decode($flow->features ?? '[]', true);
    } catch (\Throwable $e) {
    $features = [];
    }
  @endphp

  <section class="section" style="background-color: #e6f4ea; padding: 60px 0;" data-aos="fade-up">
    <div class="container">
    <h2 class="mb-4" style="font-size: 2.2rem; font-weight: 700;">{{ $flow->title }}</h2>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0 text-center" data-aos="fade-right">
      <img src="{{ asset('uploads/whatsapp-flows/' . $flow->image) }}" class="img-fluid rounded shadow"
        style="max-width: 100%; height: auto;" alt="WhatsApp Flows">
      </div>
      <div class="col-md-6" data-aos="fade-left">
      <h4 class="mb-4" style="font-size: 2rem; font-weight: 600;">{{ $flow->subtitle }}</h4>
      <ul class="list-unstyled">
        @foreach($features as $feature)
      <li class="mb-4 d-flex align-items-start">
      <i class="{{ $feature['icon'] }} me-3 mt-1"
        style="font-size: 1.5rem; color: {{ $feature['color'] ?? '#000000' }}"></i>
      <span style="font-size: 1.15rem;">
        <strong>{{ $feature['name'] }}</strong> – {{ $feature['description'] }}
      </span>
      </li>
      @endforeach
      </ul>

      </div>
    </div>
    </div>
  </section>
@endif

<!-- Appointment Section (Updated) -->
<section class="section" style="background-color: #e8f5e9;" data-aos="fade-up">

  <div class="container">
    <div class="row align-items-center">
      <!-- Left Image -->
      <div class="col-12 col-md-6 mb-4 mb-md-0 text-center" data-aos="fade-right">
        <img src="{{ asset('assets/frontend-2/images/book appointment.webp') }}" class="img-fluid rounded shadow"
          style="max-width: 100%; height: auto; border-radius: 16px;" alt="Appointment Image">
      </div>

      <!-- Right Content -->
      <div class="col-12 col-md-6" data-aos="fade-left">
        <h2 class="mb-3 text-center" style="font-size: 2.2rem; font-weight: 700;"><i
            class="fab fa-whatsapp fa-lg"></i>&nbsp;More Info For WhatsApp Chatbot</h2>
        <p class="mb-4 text-center">Choose your preferred time and date to book an appointment through WhatsApp.</p>
        <div class="text-center">
          <a href="{{ route('customer.appointment.create') }}" class="btn btn-success btn-lg" target="_blank">
            <i class="fab fa-whatsapp fa-lg"></i>
            Get More Info WhatsApp Chatbot
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WhatsApp Ticket Section -->
<section class="section py-5" style="background-color: #f2fef3;" data-aos="fade-up">
  <div class="container">

    <!-- Title -->
    <div class="row">
      <div class="col-12 text-center mb-4" data-aos="fade-up">
        <h2 style="font-weight: 700;">WhatsApp Ticket System</h2>
      </div>
    </div>

    <!-- Dynamic Carousel -->
    <div class="row mb-5" data-aos="fade-up">
      <div class="col-12">
        <div id="ticketFeatureCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
          <div class="carousel-inner">
            @foreach($ticketFeatures->chunk(2) as $chunkIndex => $chunk)
          <div class="carousel-item @if($chunkIndex === 0) active @endif">
            <div class="row g-4">
            @foreach($chunk as $feature)
            <div class="col-12 col-md-6">
            <div class="card h-100 text-center p-4">
            @if($feature->image_url)
          <img src="{{ $feature->image_url }}" class="mb-3 mx-auto" width="64" height="64" />
          @endif
            <h5><strong>{{ $feature->title }}</strong></h5>
            <p>{{ $feature->description }}</p>
            </div>
            </div>
        @endforeach
            </div>
          </div>
      @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#ticketFeatureCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#ticketFeatureCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

@include('frontend.layouts.footer')