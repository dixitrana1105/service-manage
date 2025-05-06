<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Appointment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            background: #fefefe;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 8px 8px 0 0;
        }

        .logo {
            max-height: 100px;
            margin-bottom: 10px;
        }

        .company-name {
            font-size: 1.5rem;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .footer {
            font-size: 0.9rem;
            color: #555;
            margin-top: 40px;
            text-align: center;
        }

        .footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h2 class="mb-3 text-success"><i class="bi bi-calendar-check-fill"></i> Appointment Confirmed</h2>
        <!-- Header Section -->
        <div class="header">
            <h2>Thank You, {{ $appointment->customer_name }}!</h2>
        </div>

        <!-- Add current date -->
        <h4>Date: {{ now()->format('l, F j, Y') }}</h4>
        <p>We have received your message. Here are the details:</p>

        @foreach ($company as $companys)

            @if($companys->company_name)
                <div class="company-name">{{ $companys->company_name }}</div>
            @endif
        @endforeach

        <hr>

        <div class="text-start mt-4">
            <h5><i class="bi bi-info-circle-fill"></i> Appointment Details</h5>
            <table class="table mt-2" style="width: 100%; border: 1px solid #000; border-collapse: collapse;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th style="border: 1px solid #000; padding: 10px;">
                            <i class="bi bi-person-fill"></i> Name
                        </th>
                        <th style="border: 1px solid #000; padding: 10px;">
                            <i class="bi bi-envelope-fill"></i> Email
                        </th>
                        <th style="border: 1px solid #000; padding: 10px;">
                            <i class="bi bi-chat-dots-fill"></i> Message
                        </th>
                        <th style="border: 1px solid #000; padding: 10px;">
                            <i class="bi bi-calendar-event-fill"></i> Date
                        </th>
                        <th style="border: 1px solid #000; padding: 10px;">
                            <i class="bi bi-clock-fill"></i> Time
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #000; padding: 10px;">{{ $appointment->customer_name }}</td>
                        <td style="border: 1px solid #000; padding: 10px;">{{ $appointment->customer_email }}</td>
                        <td style="border: 1px solid #000; padding: 10px;">{{ $appointment->message }}</td>
                        <td style="border: 1px solid #000; padding: 10px;">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}
                        </td>
                        <td style="border: 1px solid #000; padding: 10px;">
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <!-- @foreach ($company as $companys)
            <div class="footer">
                © {{ date('Y') }} {{ $companys->company_name }} |
                <a href="{{ $companys->website_url }}" target="_blank">{{ $companys->website_url }}</a>
            </div>
        @endforeach -->

        <!-- footer section -->
        <section class="footer_section green-footer">
            <div class="container">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By Service Management. <br>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.9416792951383!2d73.13721207575115!3d22.318045311254796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fc9586c9af68d%3A0xf1c6e92691f5579d!2sEDUCATION%20TUTORIAL!5e0!3m2!1sen!2sin!4v1744883845968!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>

                    @foreach ($company as $companys)
                            <!-- Button to website -->
                        <p style="text-align: center;">
                            <strong
                                style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif: bold ;">Project
                                Prepared
                                By : </strong>
                            <a href="{{ $companys->website_url ?? 'Website Url' }}"
                                style="font-family: 'Times New Roman', Times, serif; font-weight: bold;" target="_blank"
                                class="btn">
                                <strong style="color: #ddd;">
                                    <i class="fa fa-globe me-1" ></i>
                                    <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/c/c4/Globe_icon.svg" alt="Globe" width="16" height="16" style="vertical-align: middle; margin-right: 4px;"> -->
                                    &nbsp;Service-Management.</strong>
                            </a>
                        </p>
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
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
            </script>
    </div>
</body>

</html>