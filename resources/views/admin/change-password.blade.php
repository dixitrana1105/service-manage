@extends('admin.layouts.app')

@section('content')

<!-- Page Header -->
<section class="content-header" style="font-family: Cambria, Georgia, 'Times New Roman', serif; font-weight: bold;">
    <div class="container-fluid my-2">
        <div class="card-header bg-dark">
            <h2 class="h5 mb-0 pt-2 pb-2 text-light">
                <i class="fas fa-key me-2"></i> Change Password
            </h2>
            <p class="text-sm text-light mb-0">Update your password for enhanced account security.</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content" style="font-family: Cambria, Georgia, 'Times New Roman', serif;">
    <div class="container-fluid">
        @include("admin.message")

        <form action="" method="POST" id="changePasswordForm" name="changePasswordForm">
            @csrf
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Old Password -->
                        <div class="col-md-4 mb-3">
                            <label for="old_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter current password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#old_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <strong><p style="color: red; font-weight: bold;"></p></strong>
                        </div>

                        <!-- New Password -->
                        <div class="col-md-4 mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#new_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <strong><p style="color: red; font-weight: bold;"></p></strong>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-4 mb-3">
                            <label for="conf_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="conf_password" id="conf_password" class="form-control" placeholder="Confirm new password">
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#conf_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <strong><p style="color: red; font-weight: bold;"></p></strong>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div id="passwordCriteria" class="alert alert-warning py-2 px-3">
                            <strong>Password must contain:</strong>
                            <ul class="mb-0">
                                <li>At least 1 uppercase character</li>
                                <li>At least 1 number</li>
                                <li>Minimum 8 characters</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
                        <i class="fas fa-sync-alt me-1"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@section('customJs')
<script>
    // Show/Hide password toggle
    $('.toggle-password').on('click', function () {
        const target = $(this).data('target');
        const input = $(target);
        const icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $("#changePasswordForm").submit(function (event) {
        event.preventDefault();
        var form = $(this);
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("admin.processChangePassword") }}',
            type: 'POST',
            data: form.serializeArray(),
            dataType: 'json',
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);

                if (response.status === true) {
                    window.location.href = "{{ route('admin.showChangePasswordForm') }}";
                } else {
                    let errors = response.errors;

                    ['old_password', 'new_password', 'conf_password'].forEach(field => {
                        let input = $("#" + field);
                        let feedback = input.closest('.mb-3').find('p');

                        if (errors[field]) {
                            input.addClass('is-invalid');
                            feedback.html(errors[field]);
                        } else {
                            input.removeClass('is-invalid');
                            feedback.html("");
                        }
                    });
                }
            },
            error: function () {
                console.log("Something went wrong");
                $("button[type=submit]").prop('disabled', false);
            }
        });
    });
</script>
@endsection
