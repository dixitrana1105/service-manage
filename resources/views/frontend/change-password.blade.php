@extends('frontend.layouts.main')

@section('main-container')
    <!-- Breadcrumb Section -->
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
        @include('frontend.common.message')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-dark" href="{{ route('account.profile') }}">
                            <i class="fas fa-user"></i> My Account
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-cog"></i> Settings
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Change Password Section -->
    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3">
                    @include('frontend.common.sidebar')
                </div>
                <!-- Change Password Form -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-key"></i> Change Password</h5>
                        </div>

                        <form action="{{ route('account.changePassword') }}" method="post" id="changePasswordForm">
                            @csrf
                            <div class="card-body p-4">

                                <!-- Old Password -->
                                <div class="mb-3">
                                    <label for="old_password"><i class="fas fa-lock"></i> Old Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Enter Old Password"
                                            id="old_password" name="old_password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button"
                                            data-target="old_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="new_password"><i class="fas fa-lock"></i> New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Enter New Password"
                                            id="new_password" name="new_password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button"
                                            data-target="new_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-3">
                                    <label for="confirm_password"><i class="fas fa-lock"></i> Confirm New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Confirm New Password"
                                            id="confirm_password" name="confirm_password" required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button"
                                            data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-sync-alt"></i> Update Password
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        // Toggle Password Visibility for All Fields
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                let targetField = document.getElementById(this.dataset.target);
                let icon = this.querySelector('i');

                if (targetField.type === "password") {
                    targetField.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    targetField.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });

        // AJAX Form Submission for Password Change
        $("#changePasswordForm").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("account.processChangePassword") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if (response.status === true) {
                        window.location.href = "{{ route('account.changePassword') }}";
                    } else {
                        var errors = response.errors;
                        if (errors.old_password) {
                            $("#old_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.old_password);
                        } else {
                            $("#old_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }
                        if (errors.new_password) {
                            $("#new_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.new_password);
                        } else {
                            $("#new_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }
                        if (errors.confirm_password) {
                            $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                        } else {
                            $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        }
                    }
                }
            });
        });
    </script>
@endsection