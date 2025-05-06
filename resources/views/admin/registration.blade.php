<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Software Solutions :: Administrative Panel</title>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('./assets/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('./assets/admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/admin-assets/css/custom.css') }}">

    <!-- Custom Styles -->
    <style>
body {
			background: url("{{ asset('./assets/admin-assets/img/Admin Panel.jpg') }}") no-repeat center center fixed;
			background-size: cover;
		}

        .login-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            background: #007bff;
            color: #fff;
            text-align: center;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .form-control {
            border-radius: 5px;
        }

        .show-password {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3><i class="fas fa-user-shield"></i> Admin Registration</h3>
                </div>
                <div class="card-body">
                    <h4 class="text-center">Create an Account</h4>
                    <hr>

                    <!-- Registration Form -->
                    <form action="{{route('admin.registerUsers')}}" method="post">
                        @csrf

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif

                        <!-- Name -->
                        <div class="input-group mb-3">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('name') <p class="invalid-feedback">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email') <p class="invalid-feedback">{{ $message }}</p> @enderror
                        </div>

                        <!-- Password -->
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @error('password') <p class="invalid-feedback">{{ $message }}</p> @enderror
                        </div>

                        <!-- Show Password Checkbox -->
                        <div class="form-group show-password">
                            <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()">
                            <label for="show-password-checkbox">Show Password</label>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Select Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select Role</option>
                                <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer
                                </option>
                                <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Register Button -->
                        <div class="input-group mb-3">
                            <button class="btn btn-block btn-primary" type="submit">Register</button>
                        </div>

                        <!-- Already Registered -->
                        <a href="login">
                            <p class="text-center">Already Registered? Login Here.</p>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>