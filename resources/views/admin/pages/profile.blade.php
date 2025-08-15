@extends('admin.pages.app.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">User Profile</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card" id="profile_wrapper">
                                <div class="card-body" id="profile_info">
                                    <div class="d-flex flex-column align-items-center text-center">

                                        <div class="mt-2">
                                            <img id="img_preview" src="{{ asset(Auth::user()->profile_img) }}"
                                                alt="{{ Auth::user()->roles->first()->name }}" class="rounded-circle p-1 bg-primary" width="110">
                                        </div>
                                        <div class="mt-3">
                                            <h4>{{ Auth::user()->name }}(
                                                <small>{{ Auth::user()->roles->first()->name }}</small> )</h4>

                                            <p class="text-secondary mb-1">{{ Auth::user()->phone ?? '' }} </p>
                                            <p class="text-muted font-size-sm">{{ Auth::user()->address ?? '' }}</p>
                                            <button class="btn btn-primary">Follow</button>
                                            <button class="btn btn-outline-primary">Message</button>
                                        </div>
                                    </div>

                                    @php
                                        $socialLinks = json_decode(Auth::user()->social_links, true);
                                    @endphp
                                    @if (!empty($socialLinks))
                                        <hr class="my-4">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <h6 class="mb-0">Facebook:</h6>

                                                <a target="blank" href="{{ $socialLinks['facebook'] ?? '' }}"
                                                    class="text-secondary">{{ $socialLinks['facebook'] ?? '' }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <h6 class="mb-0">Twitter:</h6>
                                                <a target="blank" href="{{ $socialLinks['twitter'] ?? '' }}"
                                                    class="text-secondary">{{ $socialLinks['twitter'] ?? '' }}</a>
                                            </li>

                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{ route('admin.profile.save') }}" enctype="multipart/form-data"
                                        id="form_submit">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Full Name</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="full_name"
                                                    value="{{ Auth::user()->name }}" placeholder="John Doe">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input disabled type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}" placeholder="test@example.com">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Old Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control" name="old_password"
                                                        placeholder="Old Password">
                                                    <a href="javascript:;"
                                                        class="input-group-text bg-transparent toggle-password"
                                                        data-target="password">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control" name="new_password"
                                                        placeholder="New Password">
                                                    <a href="javascript:;"
                                                        class="input-group-text bg-transparent toggle-password"
                                                        data-target="password">
                                                        <i class='bx bx-hide'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Phone</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ Auth::user()->phone }}" placeholder="017 000 00000">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="address"
                                                    placeholder="Jashore, Khulna" value="{{ Auth::user()->address }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">

                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Facebook</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="url" class="form-control" name="social_links[facebook]"
                                                    value="{{ $socialLinks['facebook'] ?? '' }}"
                                                    placeholder="https://www.facebook.com">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Twitter</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="url" class="form-control" name="social_links[twitter]"
                                                    value="{{ $socialLinks['twitter'] ?? '' }}"
                                                    placeholder="https://www.x.com">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Profile Image</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" id="profile_img" name="profile_img"
                                                    class="form-control" onchange="previewImage(event)">



                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <div id="submitButtonWrapper">
                                                    <button type="submit" id="submitButton"
                                                        class="btn btn-primary px-4">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customJs')
@endsection
