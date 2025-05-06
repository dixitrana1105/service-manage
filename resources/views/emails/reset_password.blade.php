<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Password Reset Request</h3>
                    </div>
                    <div class="card-body">
                        <p>Hello {{ $user->name ?? 'User' }},</p>
                        <p>We received a request to reset your password. Click the button below to reset it:</p>
                        <p class="text-center">
                            <a href="{{ $resetLink }}" class="btn btn-success btn-lg" style="text-decoration: none;">
                                Reset Password
                            </a>
                        </p>
                        <p>If you did not request a password reset, you can ignore this email.</p>
                        @if (!empty($companyProfile->company_name))
                            <p>Thanks !<br><strong style="font-family: 'Times New Roman', Times, serif;">Company
                                    Name:</strong> {{ $companyProfile->company_name }}</p>

                        @else
                            <p>Thanks!<br>Service Management</p>
                        @endif
                        @foreach ($companyProfile as $profile)
                            @if (!empty($profile->website_url))
                                <p><a href="{{ $profile->website_url }}" class="btn btn-success btn-lg"
                                        style="text-decoration: none;"></a></p>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>