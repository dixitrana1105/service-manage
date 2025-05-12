<!-- info section -->
<section class="info_section layout_padding2" style="background-color: #0C2D48;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_contact">
          <h4>Address</h4>
          @foreach ($companyProfile as $Profile)
          <div class="contact_link_box">
            <a href="#">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>{{$Profile->office_address ?? 'Office Address'}}</span>
            </a>
            <a href="#">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>{{$Profile->phone_number ?? 'Phone Number'}}</span>
            </a>
            <a href="#">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>{{$Profile->email_address ?? 'Email Address'}}</span>
            </a>
          </div>
        </div>
      </div>
      @endforeach

      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_detail">
          <h4>Info</h4>
          <p>
            necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin
            words, combined with a handful
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-2 mx-auto info_col">
        <div class="info_link_box">
          <h4>Links</h4>
          <div class="info_links">
            <a class="active" href="{{ url('/') }}">
              <i class="fa fa-home" aria-hidden="true"></i>&nbsp; Home
            </a>
            <a class="" href="{{ url('/about') }}">
              <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; About
            </a>
            <a class="" href="{{ url('/services') }}">
              <i class="fa fa-wrench" aria-hidden="true"></i>&nbsp; Services
            </a>
            <a class="" href="{{ url('/why') }}">
              <i class="fa fa-lightbulb-o" aria-hidden="true"></i>&nbsp; Why Us
            </a>
            <a class="" href="{{ url('/team') }}">
              <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; Team
            </a>
            <a href="{{ route('home.clearCache') }}" class="footer-link">
              <i class="fas fa-recycle"></i>&nbsp; Clear/Re-sett
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 info_col">
        <h4>Subscribe</h4>

        @if(session('success'))
        <div class="text-success">{{ session('success') }}</div>
        @elseif(session('message'))
        <div class="text-warning">{{ session('message') }}</div>
        @endif

        @if(Cookie::has('subscribed_email'))
        <!-- Unsubscribe Form -->
        <form action="{{ route('front.unsubscribe') }}" method="POST" class="mt-3">
          @csrf
          @method('POST')
          <div class="input-group mb-3">
            <span class="input-group-text bg-white"><i class="fas fa-envelope-open-text text-primary"></i></span>
            <input type="email" name="email" value="{{ Cookie::get('subscribed_email') }}" readonly
              class="form-control text-dark" placeholder="Email to unsubscribe" required>
          </div>
          <button type="submit" class="btn btn-danger w-100"
            style="background:red; font-family: 'Times New Roman', Times, serif; font-size: large;">
            <i class="fas fa-bell me-1"></i> Unsubscribe
          </button>
        </form>
        @else
        <!-- Subscribe Form -->
        <form action="{{ route('subscribe') }}" method="POST" class="mt-3">
          @csrf
          <div class="input-group mb-3">
            <span class="input-group-text bg-white"><i class="fas fa-envelope text-primary"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-paper-plane"></i> Subscribe
          </button>
        </form>
        @endif
      </div>

    </div>
  </div>
</section>
<!-- end info section -->

<!-- footer section -->
<hr style="border: 1px solid #fff; width: 100%; margin: 0;">
<section class="footer_section green-footer" style="background-color: #0C2D48;">
  <div class="container">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By Software solution. <br>
      <strong style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif';">Project Prepared By
        :</strong>
      @foreach ($companyProfile as $compProfile)
      <a href="{{ $compProfile->website_url ?? '#' }}" target="_blank">
        <strong><i class="fa fa-globe me-1"></i>&nbsp;Software solution.</strong>
      </a>
      @endforeach
    </p>
  </div>
</section>

<!-- Scripts -->
<script src="{{ asset('assets/frontend-2/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/frontend-2/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend-2/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/frontend-2/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend-2/js/custom.js') }}"></script>

<!-- Additional Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Google Map -->
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

<!-- Cookie Script -->
<script>
  if (!document.cookie.includes('subscriber_id')) {
    document.cookie = "subscriber_id=" + Date.now() + "; path=/";
  }
</script>

<!-- Styling -->
<style>
  .footer_section a,
  .info_section a,
  .footer_section p,
  .info_section p,
  .info_section span,
  .footer_section h4,
  .info_section h4 {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
  }

  .footer_section a:hover,
  .info_section a:hover {
    color: lightgreen !important;
    text-decoration: underline;
  }

  input[type="email"] {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 6px 10px;
    color: #000;
  }

  button[type="submit"] {
    background-color: #28a745;
    border: none;
    padding: 6px 12px;
    color: #fff;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #218838;
  }
</style>

@yield('customJs')

</body>

</html>