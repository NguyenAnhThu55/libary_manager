@extends('layout')
@section('content')
    <style>
        .img-account-profile {
            height: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.975rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .hover-link:hover {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .size-text {
            font: 1.12em sans-serif;
        }
    </style>

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0 hover-link" href="{{ URL::to('/view-profile') }}">Thông tin cá nhân</a>
            <a class="nav-link hover-link" href="{{ URL::to('/edit-profile/' . Session::get('admin_id')) }}">Chỉnh sửa thông
                tin</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            @foreach ($get_profile as $profile)
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Hình Ảnh</div>
                        <div class="card-body text-center">
                            @if ($profile->admin_image == null)
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="{{ asset('public/image/Avatar-trang-den.png') }}" alt="">
                            @else
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="{{ URL::to('public/image/' . $profile->admin_image) }}" alt="">
                            @endif
                            <!-- Profile picture image-->

                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">{{ $profile->admin_name }}</div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Thông tin chi tiết</div>
                        <div class="card-body">

                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small size-text mb-1" for="inputUsername">Tên tài khoản</label>
                                <input class="form-control" id="inputUsername" type="text" disabled
                                    value="{{ $profile->admin_name }}">
                            </div>


                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small size-text mb-1" for="inputEmailAddress">Email:</label>
                                <input class="form-control" id="inputEmailAddress" type="email" disabled
                                    value="{{ $profile->admin_email }}">
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small size-text mb-1" for="inputOrgName">Số điện thoại</label>
                                    <input class="form-control" id="inputOrgName" type="text" disabled
                                        value="{{ $profile->admin_phone }}">
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-6">
                                    <label class="small size-text mb-1" for="inputLocation">Chức vụ</label>
                                    <input class="form-control" id="inputLocation" type="text" disabled
                                        value="{{ $profile->name }}">
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
