<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link rel="shortcut icon" href="{{ asset('assets/frontend-2/images/logo.jpg')}}" type="">

  <title> Service Management </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend-2/css/bootstrap.css')}}" />


  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- owl slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="{{ asset('assets/frontend-2/css/font-awesome.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-K5A6vjgD/Z1V5OUvTp+d7Yr4T+zBKnFZzctyD/9bEmZDxvmFlVYPSNe+1iYZrGRVWRazvGoLUWcrfwkSgyg3jw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Custom styles for this template -->
  <link href="{{ asset('assets/frontend-2/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assets/frontend-2/css/responsive.css')}}" rel="stylesheet" />

  <!-- Font Awesome CDN (place inside your <head>) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- OR Font Awesome 5+ -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- Include in <head> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <!-- Bootstrap + AOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <style>
    /* General Styles */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f7ff;
      color: #333;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
    }

    .navbar-brand img {
      max-height: 50px;
      margin-right: 10px;
    }

    .navbar-brand span {
      font-size: 28px;
      font-weight: 700;
      color: wheat;
      text-transform: uppercase;
    }

    .transparent-header {
      background-color: transparent !important;
      position: absolute;
      width: 100%;
      z-index: 10;
    }

    .green-header {
      background: linear-gradient(135deg, #4CAF50, #43A047);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
    }

    .nav-link {
      color: wheat !important;
      font-weight: 600;
    }

    .nav-link:hover {
      color: white !important;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 180px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      z-index: 1000;
    }

    .dropdown-menu a {
      color: #333;
      padding: 10px 15px;
      display: block;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      background-color: #f8f9fa;
    }

    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
    }

    .hero-section {
      position: relative;
      text-align: center;
      overflow: hidden;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    .hero-section video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 0;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    .hero-section .container {
      position: relative;
      z-index: 2;
      padding: 20px;
    }

    .hero-section h1 {
      font-size: 3.5rem;
      font-weight: 800;
    }

    .hero-section p {
      font-size: 1.2rem;
      margin-top: 20px;
    }

    #startupVideo {
      width: 100%;
      height: auto;
      object-fit: cover;
      display: block;
    }

    .section {
      padding: 80px 20px;
    }

    .section h2 {
      font-weight: 700;
      margin-bottom: 40px;
      text-align: center;
    }

    .feature-card {
      background: white;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.07);
      transition: all 0.3s ease-in-out;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.15);
    }

    .feature-card img {
      max-width: 100%;
      border-radius: 12px;
    }

    .chat-mockup {
      width: 360px;
      background: #e5ddd5;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      font-family: 'Poppins', sans-serif;
    }

    .chat-header {
      background: #075e54;
      color: white;
      padding: 15px;
      display: flex;
      align-items: center;
      font-weight: 600;
    }

    .chat-header img {
      margin-right: 10px;
    }

    .chat-body {
      padding: 15px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      background: #d0e6d0;
      min-height: 300px;
    }

    .message {
      max-width: 75%;
      padding: 10px 15px;
      border-radius: 15px;
      font-size: 0.95rem;
      line-height: 1.4;
    }

    .message.user {
      background: #dcf8c6;
      align-self: flex-end;
    }

    .message.bot {
      background: white;
      align-self: flex-start;
    }

    .footer {
      background-color: #128c7e;
      color: white;
      padding: 30px;
      text-align: center;
    }

    /* Mobile Styles */
    @media (max-width: 768px) {
      .hero-section h1 {
        font-size: 2rem;
      }

      .hero-section p {
        font-size: 1rem;
      }

      .section {
        padding: 40px 15px;
      }

      .chat-mockup {
        width: 100%;
      }
    }
  </style>



</head>

<body style="font-family: 'Times New Roman', Times, serif ; font-weight: bolder ; ">

  <div class="hero_area">

    @if (Request::is('/'))
    <div class="hero_bg_box">
      <div class="bg_img_box">
      <img src="{{ asset('assets/frontend-2/images/hero1.jpeg') }}" alt="">
      </div>
    </div>
  @endif

    <!-- header section strats -->
    <header class="header_section {{ Request::is('/') ? 'transparent-header' : 'green-header' }}">


      <div class="container-fluid" style="font-family: 'Times New Roman', Times, serif;">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ url('/') }}">
            @foreach ($companyProfile as $Profile)
          @if(!empty($Profile->company_logo))
        <img class="rounded-circle bg-light" src="{{ asset($Profile->company_logo) }}" alt="Company Logo"
        style="max-height: 50px;">
      @endif
          @if (!empty($Profile->company_name))
        <span class="typing-animation"
        style="font-family: 'Times New Roman', Times, serif;">{{ $Profile->company_name }}</span>
      @endif
          </a>
        @endforeach
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}"> Home <span class="sr-only">(current)</span></a>
              </li>
              @if ($pages->isNotEmpty())
          @foreach ($pages as $page)
        <li class="nav-item">
        <a class="nav-link" href="{{ url('page/' . $page->slug) }}">{{ $page->name }}</a>
        </li>
      @endforeach
        @endif
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ url('/services') }}">Services</a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('whatsapp-chatbot.index') }}">WhatsApp Chatbot</a></li>
                  <li><a href="{{ route('business-automation.index') }}">Business Automation</a></li>
                  <li><a href="{{ route('customer.appointment.create') }}">Book Appoinment</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('why.index') }}">Why Us</a> 
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('team.index') }}">Team</a>
              </li>

              @if(Auth::check())
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i> My Account
          </a>
          <div class="dropdown-menu" aria-labelledby="accountDropdown">
            <a class="dropdown-item" href="{{ route('account.profile') }}">Profile</a>
            <a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a>
          </div>
          </li>
        @else
        <li class="nav-item">
        <a class="nav-link" href="{{ route('account.login') }}">
          <i class="fa fa-fingerprint"></i>&nbsp; Login
        </a>
        </li>
      @endif

            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->