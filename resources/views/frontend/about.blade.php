@extends('frontend.layouts.main')

@section('main-container')

  <!-- about section -->
  <section class="about_section layout_padding" style="background-color: #d4fcd4;">
    <div class="container">
    <div class="heading_container heading_center" data-aos="fade-down" data-aos-duration="1000">
      <h2>
      <span style="color: #28a745;">About WhatsApp Chatbot</span>
      </h2>
      <p style="color: black;">
      Revolutionize customer engagement with AI-driven WhatsApp chatbot solutions for businesses.
      </p>
    </div>

    @foreach ($aboutus as $about)
    <div class="row align-items-center my-4">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
      <div class="img-box">
      @if(!empty($about->image))
      <img src="{{ asset($about->image) }}" alt="WhatsApp Chatbot" class="img-fluid rounded shadow"
      style="background-color: white;">
    @else
      <span class="text-muted">No Image</span>
    @endif
      </div>
      </div>

      <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
      <div class="detail-box">
      @if (!empty($about->title))
      <h3 class="mb-2" style="color: #28a745;">
      {{ $about->title }}
      </h3>
    @endif

      @if (!empty($about->description))
      <hr class="my-3" style="background-color: white;">
      <p class="about-description"
      style="font-family: 'Times New Roman', Times, serif; font-size: larger; font-weight: bold; color: black;">
      {{ Str::limit(strip_tags($about->description), 250, '...') }}
      <span class="more-text d-none">{{ $about->description }}</span>
      </p>

      <button class="btn btn-outline-success mt-2 read-more-btn" data-aos="zoom-in" data-aos-delay="200">
      Read More
      </button>
    @endif
      </div>
      </div>
    </div>
  @endforeach

    </div>
  </section>

  <!-- JavaScript for Read More -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.read-more-btn');

    buttons.forEach(button => {
      button.addEventListener('click', function () {
      const paragraph = button.previousElementSibling;
      const moreText = paragraph.querySelector('.more-text');

      if (moreText.classList.contains('d-none')) {
        paragraph.innerHTML = moreText.innerHTML;
        button.textContent = 'Read Less';
      } else {
        const fullText = moreText.innerHTML;
        const truncated = fullText.length > 250 ? fullText.slice(0, 250) + '...' : fullText;
        paragraph.innerHTML = truncated + '<span class="more-text d-none">' + fullText + '</span>';
        button.textContent = 'Read More';
      }
      });
    });
    });
  </script>

  <!-- end about section -->
@endsection