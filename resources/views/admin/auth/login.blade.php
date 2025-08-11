@extends('admin.auth.layout')

@section('content')
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="assets/images/logo-img.png" width="180" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                        <p>Don't have an account yet? <a href="{{ route('admin.signup') }}">Sign up
                                                here</a>
                                        </p>
                                    </div>

                                    <div class="form-body">
                                        <div id="alertbox"></div>
                                        <form class="row g-3" id="loginForm">
                                            @csrf
                                            <div class="col-12">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Email Address" name="email">
                                                <span class="text-danger" id="email_error"></span>
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Enter Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input name="password" type="password" class="form-control border-end-0"
                                                        id="password" value="" placeholder="Enter Password"> <a
                                                        href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                                <span class="text-danger" id="password_error"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckChecked" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="authentication-forgot-password.html">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
@endsection


@section('customJs')
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var url = "{{ route('admin.login.process') }}";


                $('#email_error').text("");
                $('#password_error').text("");
                $('#alertbox').html("");

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === true) {

                            $('#alertbox').html('<p class="alert alert-success">' + response
                                .message +
                                '</p>');

                            setTimeout(() => {
                                window.location.href = '{{ route('admin.dashboard') }}';
                            }, 1500);

                        } else if (response.errors) {

                            $('#alertbox').html('<p class="alert alert-danger">' + response
                                .message +
                                '</p>')
                            // Show individual field errors
                            if (response.errors.email) {
                                $('#email_error').text(response.errors.email[0]);
                            }
                            if (response.errors.password) {
                                $('#password_error').text(response.errors.password[0]);
                            }
                        } else if (response.message) {
                            $('#alertbox').html('<p class="alert alert-danger">' + response
                                .message +
                                '</p>')
                        } else {
                            alert('Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        $('#email_error').text('');
                        $('#password_error').text('');

                        if (xhr.status === false && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.email) {
                                $('#email_error').text(errors.email[0]);
                            }
                            if (errors.password) {
                                $('#password_error').text(errors.password[0]);
                            }
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            $('#alertbox').html('<p class="alert alert-danger">' + xhr
                                .responseJSON.message +
                                '</p>');


                        } else {

                            $('#alertbox').html(
                                '<p class="alert alert-danger"> An unexpected error occurred</p>'
                                );
                        }

                        console.error(xhr.responseText);
                    }

                });
            });
        });
    </script>
@endsection
