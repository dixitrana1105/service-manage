<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/login/assets/img/favicon.ico') }}">

    <!-- CSS Files -->
    @foreach ([
        'bootstrap.min.css', 'owl.carousel.min.css', 'slicknav.css', 'flaticon.css', 'progressbar_barfiller.css',
        'gijgo.css', 'animate.min.css', 'animated-headline.css', 'magnific-popup.css', 'fontawesome-all.min.css',
        'themify-icons.css', 'slick.css', 'nice-select.css', 'style.css'
    ] as $css)
        <link rel="stylesheet" href="{{ asset('assets/login/assets/css/' . $css) }}">
    @endforeach
</head>

<body>
    <!-- Preloader -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/login/assets/img/logo/loder.png') }}" alt="loader">
                </div>
            </div>
        </div>
    </div>

    <!-- Login Form -->
    <main class="login-body" data-vide-bg="{{ asset('assets/login/assets/img/login-bg.mp4') }}">
        <form class="form-default" action="{{ route('account.authenticate') }}" method="POST">
            @csrf
            <div class="login-form">
                <div class="logo-login">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/login/assets/img/logo/loder.png') }}" alt="logo">
                    </a>
                </div>
                <h2>Login Here</h2>

                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-input pt-30">
                    <input type="submit" value="Login">
                </div>

                <a href="{{ route('password.request') }}" class="registration d-block mt-2">Forgot Password&nbsp;?</a>
                <a href="{{ route('account.register') }}" class="registration d-block mt-2">New User? Register</a>
                <a href="{{ route('admin.login') }}" class="registration d-block mt-2"><strong>Admin Login</strong></a>
            </div>
        </form>
    </main>

    <!-- JS Files -->
    @foreach ([
        'vendor/modernizr-3.5.0.min.js', 'vendor/jquery-1.12.4.min.js', 'popper.min.js', 'bootstrap.min.js',
        'jquery.slicknav.min.js', 'jquery.vide.js', 'owl.carousel.min.js', 'slick.min.js', 'animated.headline.js',
        'jquery.magnific-popup.js', 'gijgo.min.js', 'jquery.nice-select.min.js', 'jquery.sticky.js',
        'jquery.barfiller.js', 'jquery.counterup.min.js', 'waypoints.min.js', 'jquery.countdown.min.js',
        'hover-direction-snake.min.js', 'contact.js', 'jquery.form.js', 'jquery.validate.min.js',
        'mail-script.js', 'jquery.ajaxchimp.min.js', 'plugins.js', 'main.js'
    ] as $js)
        <script src="{{ asset('assets/login/assets/js/' . $js) }}"></script>
    @endforeach

</body>
</html>
