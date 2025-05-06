<!-- info section -->
<style>
  /* Ensure all text in info_section is black */
  .info_section,
  .info_section h4,
  .info_section p,
  .info_section a,
  .info_section span,
  .info_section i,
  .info_section .input-group-text {
    color: rgb(250, 250, 250) !important;
  }

  /* Example of custom styling for unsubscribe button */
  .btn.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
  }
</style>

<section class="info_section layout_padding2" style="background-color: #052561">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_contact">
          <h4>
            Address
            @foreach ($companyProfile as $Profile)
            </h4>
            <div class="contact_link_box">
            <a href="">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
              {{$Profile->office_address ?? 'Office Address'}}
              </span>
            </a>
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
              {{$Profile->phone_number ?? 'Phone Number'}}
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
              {{$Profile->email_address ?? 'Email Address'}}
              </span>
            </a>
            </div>
          </div>
          <!--
            <div class="info_social">
            @if(!empty($Profile->social_media_links))
              <i class="fa fa-facebook" aria-hidden="true"></i>
              <a href="{{ $Profile->social_media_links }}" target="_blank" rel="noopener noreferrer">
              {{ $Profile->social_media_links }}
              </a>
            @else
            <i class="fa fa-facebook" aria-hidden="true"></i>
            <span>Social Media Links</span>
            @endif
            </div>
            -->
          </div>
        @endforeach

      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_detail">
          <h4>
            Info
          </h4>
          <p>
            necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin
            words, combined with a handful
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mx-auto info_col">
        <div class="info_link_box">
          <h4>
            Links
          </h4>
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
              <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Team
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
      <div style="color: white;">{{ session('success') }}</div>
    @elseif(session('message'))
      <div style="color: orange;">{{ session('message') }}</div>
    @endif

        @if(Cookie::has('subscribed_email'))
      <!-- Unsubscribe Form -->
      <form action="{{ route('front.unsubscribe') }}" method="POST" style="position: relative;">
        @csrf
        @Method('POST')
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
        </div>

        <input style="color: black;" type="email" name="email" value="{{ Cookie::get('subscribed_email') }}" readonly class="form-control"
          placeholder="Email to unsubscribe" required>



        </div>
        <button type="submit" class="btn btn-danger"
        style="background:red; font-family: 'Times New Roman', Times, serif; font-size: large;">
        <i class="fas fa-times-circle"></i> Unsubscribe
        </button>
      </form>
    @else
      <!-- Subscribe Form -->
      <form action="{{ route('subscribe') }}" method="POST" style="position: relative;">
        @csrf
        <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
        </div>
        <input type="email" name="email" class="form-control" placeholder="Enter email" required />
        </div>
        <button type="submit" class="btn btn-primary">
         Subscribe
        </button>
      </form>
    @endif
      </div>




    </div>
  </div>
</section>
<!-- end info section -->


<!-- footer section -->
<section class="footer_section green-footer">
  <div class="container">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By Service Management. <br>
      <strong style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif: bold ;">Project Prepared
        By : </strong>
      @foreach ($companyProfile as $compProfile)
      <a href="{{ $compProfile->website_url ?? 'Website Url' }}"
      style="font-family: 'Times New Roman', Times, serif; font-weight: bold;" target="_blank">
      <strong><i class="fa fa-globe me-1"></i>&nbsp;Service-Management.</strong>
      </a>
    @endforeach
    </p>
  </div>
</section>
<!-- footer section -->

<!-- jQery -->
<script src="{{ asset('assets/frontend-2/js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="{{ asset('assets/frontend-2/js/popper.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('assets/frontend-2/js/bootstrap.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('assets/frontend-2/js/owl.carousel.min.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('assets/frontend-2/js/custom.js') }}"></script>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
@yield('customJs')

</body>

</html>
