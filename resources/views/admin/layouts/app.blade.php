<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('public/assets/admin-assets/img/Admin-Panel logo.jpg') }}">
    <title>Service-Management :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/css/adminlte.min.css') }}">

    <!-- Add to the <head> section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Bootstrap CSS in head -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}"> -->
    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/plugins/summernote/summernote.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/css/datetimepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/admin-assets/css/custom.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <!-- Toggle Sidebar Button -->
                <li class="nav-item d-flex align-items-center">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                        <img src="{{ asset('public/assets/admin-assets/img/home.ico') }}" alt="Home Icon"
                            style="width: 20px; height: 20px; margin-right: 10px;">
                        <strong class="ml-2">Home</strong>
                    </a>
                </li>

                <!-- <li class="nav-item d-flex align-items-center p-0 m-0">
                    <a class="nav-link p-0 m-0" data-widget="pushmenu" href="#" role="button"
                        aria-label="Toggle Sidebar">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="icon-xl-heavy max-md:hidden">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.85719 3H15.1428C16.2266 2.99999 17.1007 2.99998 17.8086 3.05782C18.5375 3.11737 19.1777 3.24318 19.77 3.54497C20.7108 4.02433 21.4757 4.78924 21.955 5.73005C22.2568 6.32234 22.3826 6.96253 22.4422 7.69138C22.5 8.39925 22.5 9.27339 22.5 10.3572V13.6428C22.5 14.7266 22.5 15.6008 22.4422 16.3086C22.3826 17.0375 22.2568 17.6777 21.955 18.27C21.4757 19.2108 20.7108 19.9757 19.77 20.455C19.1777 20.7568 18.5375 20.8826 17.8086 20.9422C17.1008 21 16.2266 21 15.1428 21H8.85717C7.77339 21 6.89925 21 6.19138 20.9422C5.46253 20.8826 4.82234 20.7568 4.23005 20.455C3.28924 19.9757 2.52433 19.2108 2.04497 18.27C1.74318 17.6777 1.61737 17.0375 1.55782 16.3086C1.49998 15.6007 1.49999 14.7266 1.5 13.6428V10.3572C1.49999 9.27341 1.49998 8.39926 1.55782 7.69138C1.61737 6.96253 1.74318 6.32234 2.04497 5.73005C2.52433 4.78924 3.28924 4.02433 4.23005 3.54497C4.82234 3.24318 5.46253 3.11737 6.19138 3.05782C6.89926 2.99998 7.77341 2.99999 8.85719 3ZM6.35424 5.05118C5.74907 5.10062 5.40138 5.19279 5.13803 5.32698C4.57354 5.6146 4.1146 6.07354 3.82698 6.63803C3.69279 6.90138 3.60062 7.24907 3.55118 7.85424C3.50078 8.47108 3.5 9.26339 3.5 10.4V13.6C3.5 14.7366 3.50078 15.5289 3.55118 16.1458C3.60062 16.7509 3.69279 17.0986 3.82698 17.362C4.1146 17.9265 4.57354 18.3854 5.13803 18.673C5.40138 18.8072 5.74907 18.8994 6.35424 18.9488C6.97108 18.9992 7.76339 19 8.9 19H9.5V5H8.9C7.76339 5 6.97108 5.00078 6.35424 5.05118ZM11.5 5V19H15.1C16.2366 19 17.0289 18.9992 17.6458 18.9488C18.2509 18.8994 18.5986 18.8072 18.862 18.673C19.4265 18.3854 19.8854 17.9265 20.173 17.362C20.3072 17.0986 20.3994 16.7509 20.4488 16.1458C20.4992 15.5289 20.5 14.7366 20.5 13.6V10.4C20.5 9.26339 20.4992 8.47108 20.4488 7.85424C20.3994 7.24907 20.3072 6.90138 20.173 6.63803C19.8854 6.07354 19.4265 5.6146 18.862 5.32698C18.5986 5.19279 18.2509 5.10062 17.6458 5.05118C17.0289 5.00078 16.2366 5 15.1 5H11.5ZM5 8.5C5 7.94772 5.44772 7.5 6 7.5H7C7.55229 7.5 8 7.94772 8 8.5C8 9.05229 7.55229 9.5 7 9.5H6C5.44772 9.5 5 9.05229 5 8.5ZM5 12C5 11.4477 5.44772 11 6 11H7C7.55229 11 8 11.4477 8 12C8 12.5523 7.55229 13 7 13H6C5.44772 13 5 12.5523 5 12Z"
                                fill="currentColor"></path>
                        </svg>&nbsp;
                    </a>

                    <a class="nav-link p-0 m-0" href="{{ route('admin.dashboard') }}">
                        <strong>Home</strong>
                    </a>
                </li> -->

                </li>
            </ul>



            <!-- Breadcrumb placeholder (Optional, uncomment if needed) -->
            <!--
    <div class="navbar-nav pl-2">
        <ol class="breadcrumb p-0 m-0 bg-white">
            <li class="breadcrumb-item"><a href="products.html">Products</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Fullscreen button -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <!-- <i class="fas fa-expand-arrows-alt"></i> -->
                        <image src="https://ssl.gstatic.com/gb/images/bar/al-icon.png" alt="" height="24" width="24">
                        </image>
                    </a>
                </li>


                <!-- User dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                        <img src="{{ asset('public/assets/admin-assets/img/avatar5.png') }}" class="img-circle elevation-2"
                            width="40" height="40" alt="User Avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                        <div class="text-center">
                            <h4 class="h4 mb-0"><strong>{{ Auth::guard('admin')->user()->name }}</strong></h4>
                            <hr>
                            <div class="mb-3">{{ Auth::guard('admin')->user()->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <!-- Optional Settings Link -->
                        <!--
                <div class="text-center">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2"></i> Settings
                    </a>
                </div>
                -->
                        <div class="dropdown-divider"></div>
                        <!-- Change Password -->
                        <div class="text-center">
                            <a href="{{ route('admin.showChangePasswordForm') }}" class="dropdown-item">
                                <i class="fas fa-lock mr-2"></i> Change Password
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <!-- Logout -->
                        <div class="text-center">
                            <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-center py-3 bg-light border-top">
            <div class="container">
                <p class="mb-1"
                    style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-weight: bold;">
                    &copy; 2024-2025 Service Management. All rights reserved.
                </p>

                <p class="mb-0"
                    style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; font-weight: bold;">
                    Project Prepared By:

                    @if (!empty($companyProfile))
                        <a href="{{ $companyProfile->website_url ?? '#' }}"
                            style="font-family: 'Times New Roman', Times, serif; font-weight: bold;" target="_blank">
                            <i class="fa fa-globe me-1"></i>&nbsp;Service-Management
                        </a>
                    @endif

                </p>
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('./assets/admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('./assets/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('./assets/admin-assets/js/adminlte.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('./assets/admin-assets/plugins/summernote/summernote.min.js') }}"></script>

    <script src="{{ asset('./assets/admin-assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('./assets/admin-assets/js/demo.js') }}"></script>

    <script src="{{ asset('./assets/admin-assets/js/datetimepicker.js') }}"></script>

    <script src="{{ asset('./assets/admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Required Bootstrap JS (usually at the end of body) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Add to the bottom of the body or in a script section -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Bootstrap JS and jQuery (required for modal functionality) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 250,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>   -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        flatpickr("#holidays", {
            mode: "multiple",        // Allow multiple dates to be selected
            dateFormat: "Y-m-d",      // Format for storing dates
            disableMobile: true,      // Disable mobile popup style
            placeholder: "e.g. 2025-05-06"
        });
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $(".summernote").summernote({
                height: 250,  // Corrected from semicolon to comma
            });
        });
    </script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById("companyGrowthChart").getContext("2d");

            var companyGrowthChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: ["2019", "2020", "2021", "2022", "2023", "2024", "2025"], // X-axis labels
                    datasets: [{
                        label: "Revenue Growth (in Millions)",
                        data: [2.5, 3.8, 5.2, 7.5, 9.1, 12.4, 15.3], // Sample data
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(54, 162, 235, 1)",
                        tension: 0.4 // Smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Revenue (in Millions ₹.)"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Years"
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: "top"
                        }
                    }
                }
            });
        });
    </script>
    @yield('customJs')
</body>

</html>