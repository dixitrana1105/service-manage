@include('frontend.layouts.header')
@section('main-container')

<!-- HERO SECTION WITH VIDEO BACKGROUND -->
<section class="hero-section position-relative text-white" style="min-height: 100vh; overflow: hidden;">
  <!-- Background Video -->
  @foreach ($banner as $baners)
    @if ($baners->media_type)
    @if ($baners->media_type === 'video')
    <video autoplay muted loop playsinline class="hero-video">
    <source src="{{ asset($baners->image) }}" type="video/mp4">
    Your browser does not support the video tag.
    </video>
  @else
  <img src="{{ asset($baners->image) }}" width="80" height="60" alt="Section Image">
@endif
  @else
  <span class="text-muted">No Media</span>
@endif
  @endforeach

  <!-- Overlay (optional for contrast) -->
  <div class="overlay"></div>

  <!-- Content on Video -->
  <div
    class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative text-center px-3">
    @foreach ($banner as $baners)
    <h1 class="display-5 fw-bold mb-3">{{ $baners->title }}</h1>
    <blockquote style="font-family: 'Times New Roman', Times, serif; font-size: larger;">
      {!! $baners->subtitle !!}
    </blockquote>
  @endforeach
  </div>
</section>



<!-- WhatsApp Chat Mockup with Video -->
<section class="section bg-light" data-aos="zoom-in">
  <div class="container">
    <h2 class="text-center mb-5">Live WhatsApp Chat Preview</h2>
    <div class="row align-items-center">

      <!-- Left: Chat Mockup -->
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="chat-mockup mx-auto">
          <div class="chat-header">
            <img src="https://img.icons8.com/color/48/whatsapp--v1.png" width="28" alt="whatsapp icon" />
            Customer Support
          </div>
          <div class="chat-body">
            <div class="message user">Hi! I need help booking an appointment.</div>
            <div class="message bot">Sure! What date and time would you prefer?</div>
            <div class="message user">Tomorrow at 10 AM.</div>
            <div class="message bot">✅ Appointment confirmed for tomorrow at 10 AM.</div>
          </div>
        </div>
      </div>

      <!-- Right: Video -->
      <div class="col-md-6">
        <div class="ratio ratio-16x9">
          <iframe src="{{ asset('assets/frontend-2/video/livechat.mp4') }}" title="WhatsApp Chatbot Preview" autoplay
            muted allowfullscreen></iframe>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- WhatsApp Flow Section -->
<section class="section" data-aos="fade-up">
  <div class="container">
    <h2 class="mb-4" style="font-size: 2.2rem; font-weight: 700;">Interactive WhatsApp Flows</h2>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0 text-center" data-aos="fade-right">
        <img src="{{ asset('./assets/frontend-2/images/whatsapp-flows.png') }}" class="img-fluid rounded shadow"
          style="max-width: 100%; height: auto; border-radius: 16px;" alt="WhatsApp Flows">
      </div>

      <div class="col-md-6" data-aos="fade-left">
        <h4 class="mb-4" style="font-size: 2rem; font-weight: 600;">Build Powerful Flows with Ease</h4>
        <ul class="list-unstyled">
          <li class="mb-4 d-flex align-items-start">
            <img src="https://img.icons8.com/fluency/30/flow-chart.png" class="me-3 mt-1" />
            <span style="font-size: 1.15rem;"><strong>Visual Flow Builder</strong> – Drag and drop to design
              conversations easily.</span>
          </li>
          <li class="mb-4 d-flex align-items-start">
            <img src="https://img.icons8.com/fluency/30/question-mark.png" class="me-3 mt-1" />
            <span style="font-size: 1.15rem;"><strong>Smart Decisions</strong> – Respond dynamically based on user
              input.</span>
          </li>
          <li class="mb-4 d-flex align-items-start">
            <img src="https://img.icons8.com/fluency/30/clock--v1.png" class="me-3 mt-1" />
            <span style="font-size: 1.15rem;"><strong>Real-Time Replies</strong> – Automate conversations with instant
              responses.</span>
          </li>
          <li class="mb-4 d-flex align-items-start">
            <img src="https://img.icons8.com/fluency/30/data-in-both-directions.png" class="me-3 mt-1" />
            <span style="font-size: 1.15rem;"><strong>Data Collection</strong> – Collect user info through structured
              flows.</span>
          </li>
          <li class="mb-4 d-flex align-items-start">
            <img
              src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/96/external-api-digital-marketing-flatart-icons-outline-flatarticons.png"
              class="me-3 mt-1" width="30" />
            <span style="font-size: 1.15rem;"><strong>Easy Integration</strong> – Connect with APIs, CRMs, and
              external tools.</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="section bg-light" data-aos="fade-up" style="padding-top: 100px; padding-bottom: 100px;">
  <div class="container">
    <h2 class="mb-5 text-center" style="font-weight: bold; font-size: 32px;">Our WhatsApp Chatbot Services</h2>
    <div class="row g-4">

      @foreach($services as $index => $service)
      <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
      <div class="feature-card text-center p-4 bg-white shadow rounded">
        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="mb-3" width="80" />
        <h5 class="fw-bold mb-2">{{ $service->title }}</h5>
        <p>{!! $service->description !!}</p>
      </div>
      </div>
    @endforeach

    </div>
  </div>
</section>


<!-- Appointment Section (Updated) -->
<section class="section" style="background-color: #e8f5e9;" data-aos="fade-up">

  <div class="container">
    <div class="row align-items-center">
      <!-- Left Image -->
      <div class="col-md-6 mb-4 mb-md-0 text-center" data-aos="fade-right">
        <img src="{{ asset('assets/frontend-2/images/book appointment.webp') }}" class="img-fluid rounded shadow"
          style="max-width: 100%; height: auto; border-radius: 16px;" alt="Appointment Image">
      </div>

      <!-- Right Content -->
      <div class="col-md-6" data-aos="fade-left">
        <h2 class="mb-3 text-center" style="font-size: 2.2rem; font-weight: 700;"><i
            class="fab fa-whatsapp fa-lg"></i>&nbsp;More Info For WhatsApp Chatbot</h2>
        <p class="mb-4 text-center">Choose your preferred time and date to book an appointment through WhatsApp.</p>
        <div class="text-center">
          <a href="#" class="btn btn-success btn-lg" target="_blank">
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
        <div class="col-md-6">
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

          <!-- Carousel Controls -->
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

    <!-- CTA Button -->
    <div class="row text-center" data-aos="fade-up">
      <div class="col-12">
        <a href="https://api.whatsapp.com/send?phone=9725940560&text=Hi%2C%20I%20have%20an%20issue%20to%20report."
          class="btn btn-success btn-lg">
          Raise a Ticket via WhatsApp
        </a>
      </div>
    </div>

  </div>
</section>

@include('frontend.layouts.footer')





<!-- <li class="nav-item dropdown">

                <a class="nav-link" href="{{ url('/services') }}">Services</a>
                <ul class="dropdown-menu">
                  <li><a href="{{ url('/whatsapp-chatbot') }}">WhatsApp Chatbot</a></li>
                  <li><a href="{{ url('/business-automation') }}">Business Automation</a></li>
                  <li><a href="{{ route('customer.appointment.create') }}">Book Appoinment</a></li>
                </ul>
              </li> -->