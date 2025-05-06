@extends('admin.layouts.app')

@section('content')
    <style>
        .form-group {
            position: relative;
            margin: 20px 0;
        }

        .form-group label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: #fff;
            padding: 0 5px;
            font-size: 14px;
            color: #5f6368;
            transition: all 0.2s ease;
            pointer-events: none;
        }

        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
        }

        .forgot-link {
            color: #1a73e8;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .btn-dark {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        .btn-dark:hover {
            background-color: #555;
        }

        .show-password {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .show-password label {
            margin-left: 5px;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i><strong
                            style="font-family: 'Times New Roman', Times, serif;">&nbsp;Back to User</strong>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include("admin.message")


            <form action="{{ route('users.update', $user->id) }}" method="POST" id="userForm" name="userForm">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 text-muted">
                                <div class="mb-3">
                                    <label for="name">Enter Your Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                        value="{{ $user->name }}">
                                    <p></p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 text-muted">
                                <div class="mb-3">
                                    <label for="email">Enter Your Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                        value="{{ $user->email }}" autocomplete="email">
                                    <p></p>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 text-muted" style="font-family: 'Times New Roman'; font-weight: bolder;">
                                <div class="mb-3">
                                    <label for="password">Enter Your Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter Your Password Min 10 to 15 Words">
                                    <p></p>
                                    <div class="form-group show-password">
                                        <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()">
                                        <label for="show-password-checkbox">Show Password</label>
                                    </div>
                                    <ul>
                                        <li><strong>To change password, enter a new one; otherwise leave it blank.</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 text-muted">
                                <div class="mb-3">
                                    <label for="phone">Enter Your Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone"
                                        value="{{ $user->phone }}">
                                    <p></p>
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="col-md-6 text-muted">
                                <div class="mb-3">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }

        $("#userForm").submit(function (event) {
            event.preventDefault();
            const form = $(this);
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route("users.update", $user->id) }}',
                type: 'PUT',
                data: form.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status === true) {
                        window.location.href = "{{ route('users.index') }}";
                    } else {
                        const errors = response.errors || {};
                        ['name', 'email', 'password', 'phone'].forEach(field => {
                            if (errors[field]) {
                                $("#" + field).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors[field]);
                            } else {
                                $("#" + field).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                            }
                        });

                        if (response.notFound) {
                            window.location.href = "{{ route('users.index') }}";
                        }
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