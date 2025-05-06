@extends('frontend.layouts.main')

@section('main-container')
    @include('frontend.common.message')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">

            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a>
                    </li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5">
            <div class="row">


                <div class="col-md-3">
                    @include('frontend.common.sidebar')
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="" method="post" name="profileForm" id="profileForm">
                            @csrf
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ $user->email }}" placeholder="Enter Your Email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="{{ $user->phone }}" placeholder="Enter Your Phone">
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
              
                    <div class="card mt-5">
                        <div class="card-header bg-dark text-white">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <form action="" method="post" name="addressForm" id="addressForm">
                            @csrf
                            
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control"
                                            value="{{ $address->first_name ?? '' }}" placeholder="Enter Your First Name">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control"
                                            value="{{ $address->last_name ?? '' }}" placeholder="Enter Your Last Name">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control"
                                            value="{{ $address->mobile ?? '' }}" placeholder="Enter Your Mobile">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="apartment">Apartment</label>
                                        <input type="text" name="apartment" id="apartment" class="form-control"
                                            value="{{ $address->apartment ?? '' }}" placeholder="Enter Your Apartment">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $address->email ?? '' }}" placeholder="Enter Your E-mail">
                                        <p></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="3"
                                            placeholder="Enter Your Address">{{ $address->address ?? '' }}</textarea>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h4 style="font-weight:bolder ;">
                                            <label for="country_id" style="font-size: 18px;"
                                                class="text-muted">Country:</label>
                                        </h4>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if ($countries->isNotEmpty())
                                                @foreach ($countries as $country)
                                                    <option {{ (!empty($address) && $address->country_id == $country->id) ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                        <!-- <label for="country">Country</label>
                                                            <input type="text" name="country" id="country" class="form-control"
                                                                value="{{ $address->country ?? '' }}" placeholder="Enter Your Country"> -->
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h4 style="font-weight:bolder ;">
                                            <label for="state_id" style="font-size: 18px;" class="text-muted">State
                                                :</label>
                                        </h4>
                                        <select name="state_id" id="state_id" class="form-control">
                                            <option value="">Select a State</option>
                                            @if ($states->isNotEmpty())
                                                @foreach ($states as $state)
                                                    <option {{ (!empty($address) && $address->state_id == $state->id) ? 'selected' : '' }} value="{{ $state->id }}">{{ $state->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                        <!-- <label for="state">State</label>
                                                        <input type="text" name="state" id="state" class="form-control"
                                                            value="{{ $address->state ?? '' }}" placeholder="Enter Your State"> -->
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h4 style="font-weight:bolder ;">
                                            <label for="state_id" style="font-size: 18px;" class="text-muted">City
                                                :</label>
                                        </h4>
                                        <select name="city_id" id="city_id" class="form-control">
                                            <option value="">Select a City</option>
                                            @if ($city->isNotEmpty())
                                                @foreach ($city as $cities)
                                                    <option {{ (!empty($address) && $address->city_id == $cities->id) ? 'selected' : '' }} value="{{ $cities->id }}">{{ $cities->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                        <!-- <label for="city">City</label>
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        value="{{ $address->city ?? '' }}" placeholder="Enter Your City"> -->
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h4 style="font-weight:bolder ;">
                                            <label for="postal_code" style="font-size: 18px;" class="text-muted">Zip-Code
                                                :</label>
                                        </h4>
                                        <input type="number" name="postal_code" id="postal_code" class="form-control"
                                            value="{{ $address->postal_code ?? '' }}" placeholder="Enter Your Zip Code">
                                        <p></p>
                                    </div>

                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-dark">Update</button>
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
    <script type="text/javascript">
        $("#profileForm").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route("account.updateProfile") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if (response.status == true) {

                        $("profileForm #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("profileForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        $("profileForm #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        window.location.href = '{{ route("account.profile") }}';
                    } else {
                        var errors = response.errors;
                        if (errors.name) {
                            $("profileForm #name").addClass('is-invalid').siblings('p').html(errors.name).addClass('invalid-feedback');
                        } else {
                            $("profileForm #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }
                        if (errors.email) {
                            $("profileForm #email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                        } else {
                            $("profileForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }
                        if (errors.phone) {
                            $("profileForm #phone").addClass('is-invalid').siblings('p').html(errors.phone).addClass('invalid-feedback');
                        } else {
                            $("profileForm #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                        }
                    }
                }

            });
        });
        // addressForm
        $("#addressForm").submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: '{{ route("account.updateAddress") }}',
                type: 'POST',
                data: $(this).serialize(),  // Serialize the form data
                dataType: 'json',
                success: function (response) {
                    if (response.status == true) {
                        // Clear previous error messages
                        $(".form-control").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');

                        // Redirect or show success message
                        window.location.href = '{{ route("account.profile") }}';
                    } else {
                        var errors = response.errors;
                        // Handle errors for each field
                        if (errors.first_name) {
                            $("#first_name").addClass('is-invalid').siblings('p').html(errors.first_name).addClass('invalid-feedback');
                        }
                        if (errors.last_name) {
                            $("#last_name").addClass('is-invalid').siblings('p').html(errors.last_name).addClass('invalid-feedback');
                        }
                        if (errors.mobile) {
                            $("#mobile").addClass('is-invalid').siblings('p').html(errors.mobile).addClass('invalid-feedback');
                        }
                        if (errors.email) {
                            $("#email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                        }
                        if (errors.address) {
                            $("#address").addClass('is-invalid').siblings('p').html(errors.address).addClass('invalid-feedback');
                        }
                        if (errors.postal_code) {
                            $("#postal_code").addClass('is-invalid').siblings('p').html(errors.postal_code).addClass('invalid-feedback');
                        }
                        if (errors.country_id) {
                            $("#country_id").addClass('is-invalid').siblings('p').html(errors.country_id).addClass('invalid-feedback');
                        }
                        if (errors.state_id) {
                            $("#state_id").addClass('is-invalid').siblings('p').html(errors.state_id).addClass('invalid-feedback');
                        }
                        if (errors.city_id) {
                            $("#city_id").addClass('is-invalid').siblings('p').html(errors.city_id).addClass('invalid-feedback');
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX error: " + status + " " + error);
                }
            });
        });

    </script>
@endsection