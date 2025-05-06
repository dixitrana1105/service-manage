@component('mail::message')
# 🎉 Hello Subscriber!

Thank you for subscribing with the email:

**<span style="color:#007bff;">{{ $subscriber->email }}</span>**

We’re excited to have you on board! You'll now receive updates about our latest news, features, and special offers.

@component('mail::button', ['url' => url('/'), 'color' => 'primary'])
Visit Our Website
@endcomponent

If you didn't subscribe to this newsletter, please ignore this email.

Thanks again,
<strong style="color:#343a40;">{{ config('app.name') }}</strong>

@endcomponent