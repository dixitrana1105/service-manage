<h2>Thank You, {{ $appoinment['customer_name'] }}!</h2>
 <!-- Add current date -->
 <h4>Date: {{ now()->format('l, F j, Y') }}</h4> <!-- Example format: "Friday, November 30, 2024" -->
<p>We received your message. Here are the details:</p>
<p><strong>Name:</strong> {{ $appoinment['customer_name'] }}</p>
<p><strong>Email:</strong> {{ $appoinment['email'] }}</p>
<p><strong>Subject:</strong> {{ $appoinment['subject'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $appoinment['message'] }}</p>
<p>We will get back to you soon!</p>
