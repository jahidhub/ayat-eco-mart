@extends('admin.auth.layout')

@section('customCss')
    <style>
        .is-invalid {
            border-color: #dc3545;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{ asset('admin/assets/images/logo-img.png') }}" width="180" alt="Logo" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3>Sign Up</h3>
                                        <p>Already have an account? <a href="{{ route('admin.login') }}">Sign in here</a></p>
                                    </div>
                                    <div class="form-body">
                                        <div id="alertbox"></div>
                                        <form class="row g-3" id="signupForm">
                                            @csrf
                                            <div class="col-sm-6">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name"
                                                    placeholder="First Name">

                                                <span class="text-danger" id="first_name_error"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    placeholder="Last Name">
                                            </div>
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="example@user.com">
                                                <span class="text-danger" id="email_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="password"
                                                        name="password" placeholder="Enter Password">
                                                    <a href="javascript:;"
                                                        class="input-group-text bg-transparent toggle-password"
                                                        data-target="password">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                                <span class="text-danger" id="password_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <label for="password_confirmation" class="form-label">Confirm
                                                    Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Confirm Password">
                                                </div>
                                                <span class="text-danger" id="password_confirmation_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class='bx bx-user'></i> Sign Up</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> <!-- .form-body -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {


            $('#signupForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = "{{ route('admin.signup.process') }}";
                // Clear previous errors

                $('#first_name_error').text("");
                $('#email_error').text("");
                $('#password_error').text("");
                $('#password_confirmation_error').text("");

                $('#alertbox').html('');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status === true) {
                            $('#alertbox').html(
                                '<div class="alert alert-success">Registration successful. Redirecting...</div>'
                            );
                            setTimeout(() => {
                                window.location.href =
                                    "{{ route('admin.login') }}";
                            }, 1500);
                        } else if (response.errors) {


                            if (response.errors.first_name) {

                                $('#first_name_error').text(response.errors.first_name[0]);
                            }
                            if (response.errors.email) {

                                $('#email_error').text(response.errors.email[0]);
                            }
                            if (response.errors.password) {

                                $('#password_error').text(response.errors.password[0]);
                            }
                            if (response.errors.password_confirmation) {

                                $('#password_confirmation_error').text(response.errors.password_confirmation[0]);
                            }



                        } else {
                            $('#alertbox').html(
                                '<div class="alert alert-danger">Something went wrong.</div>'
                            );
                        }
                    },
                    error: function(xhr) {
                        $('#alertbox').html(
                            '<div class="alert alert-danger">Unexpected error occurred.</div>'
                        );
                        console.error(xhr.responseText);
                    }
                });
            });



        });
    </script>
@endsection
