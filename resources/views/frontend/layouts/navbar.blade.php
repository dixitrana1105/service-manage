<header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ url('/') }}">
          @foreach ($companyProfile as $Profile)
            @if(!empty($Profile->company_logo))
              <img class="rounded-circle bg-light" src="{{ asset($Profile->company_logo) }}" alt="Company Logo"
                style="max-height: 50px;">
            @endif
            @if (!empty($Profile->company_name))
              <span class="typing-animation" style="font-family: 'Times New Roman', Times, serif;">{{ $Profile->company_name }}</span>
            @endif
          @endforeach
        </a>
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
                <li><a href="{{ url('/whatsapp-chatbot') }}">WhatsApp Chatbot</a></li>
                <li><a href="{{ url('/business-automation') }}">Business Automation</a></li>
                <li><a href="{{ route('customer.appointment.create') }}">Book Appoinment</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  