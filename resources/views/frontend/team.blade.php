@extends('frontend.layouts.main')

@section('main-container')

  <!-- team section -->
  <section class="team_section layout_padding" style="background-color: #d4fcd4;">
    <div class="container-fluid">
    <div class="heading_container heading_center" data-aos="fade-down" data-aos-duration="1000">
      <h2>
      <span>Our Team</span>
      </h2>
    </div>

    <div class="team_container">
      <div class="row">
      @foreach($teams as $team)
      <div class="col-lg-3 col-sm-6" data-aos="fade-up" data-aos-duration="1200">
      <div class="box">
      <div class="img-box">
        <img src="{{ asset($team->image) }}" class="img1" alt="{{ $team->name }}">
      </div>
      <div class="detail-box">
        <h5>
        {{ $team->name }}
        </h5>
        <p>
        {{ $team->designation }}
        </p>
      </div>
      <div class="social_box">
        <a href="{{ $team->facebook }}" target="_blank">
        <i class="fab fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="{{ $team->twitter }}" target="_blank">
        <i class="fab fa-x-twitter"></i>
        </a>
        <a href="{{ $team->linkedin }}" target="_blank">
        <i class="fab fa-linkedin"></i>
        </a>
        <a href="{{ $team->twitter }}" target="_blank">
        <i class="fab fa-instagram"></i>
        </a>
        <a href="{{ $team->youtube }}" target="_blank">
        <i class="fab fa-youtube"></i>
        </a>
      </div>
      </div>
      </div>
    @endforeach
      </div>
    </div>
    </div>
  </section>
  <!-- end team section -->

@endsection