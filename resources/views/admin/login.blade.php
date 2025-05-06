<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Software Solutions :: Administrative Panel</title>

	<!-- Google Font: Source Sans Pro -->
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
			overflow: hidden;
		}

		.card-header {
			background: #007bff;
			color: #fff;
		}

		.card-body {
			background: #f8f9fa;
			padding: 20px;
			border-radius: 0 0 10px 10px;
		}

		.btn-primary {
			background: #007bff;
			border: none;
			border-radius: 5px;
			padding: 10px;
		}

		.btn-primary:hover {
			background: #0056b3;
		}
	</style>
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		@include('admin.message')

		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="#" class="h3" style="font-family: Georgia, 'Times New Roman', Times, serif;">
					<i class="fas fa-user-shield"></i> Administrative Panel
				</a>
			</div>

			<div class="card-body">
				<h5 class="text-center" style="font-family: 'Times New Roman', Times, serif; font-weight: bold;">
					Sign in to Start your Session:
				</h5>
				<hr>
				<form action="{{ route('admin.authenticate') }}" method="post">
					@csrf
					<div class="input-group mb-3">
						<input type="email" value="{{ old('email')}}" name="email" id="email"
							class="form-control @error('email') is-invalid @enderror" placeholder="Email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
						@error('email')
							<p class="invalid-feedback">{{ $message }}</p>
						@enderror
					</div>

					<div class="input-group mb-3">
						<input type="password" name="password" id="password"
							class="form-control @error('password') is-invalid @enderror" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
						@error('password')
							<p class="invalid-feedback">{{ $message }}</p>
						@enderror
					</div>

					<div class="row">
						<div class="col-12 center">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
				</form>

				<br>
				<a href="{{ route('admin.registration') }}">
					<p class="text-center"> Don't have an Account? Register Here!</p>
				</a>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('./assets/admin-assets/plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('./assets/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('./assets/admin-assets/js/adminlte.min.js') }}"></script>
</body>

</html>