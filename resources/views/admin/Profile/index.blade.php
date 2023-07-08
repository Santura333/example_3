@extends('admin.admin_master')

@section('title', 'Admin Profile')

{{-- session 'dashboard_content' duoc goi o admin.admin_master --}}
@section('dashboard_content')
<section class="content">
    {{-- <div class="row">
        <div class="col-12 col-lg-5 col-xl-6">
            <div class=" ">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-info">Edit
                        Profile</a>
                    <h3 class="widget-user-username">Admin Name: {{ $adminData->name }}</h3>
                    <h6 class="widget-user-desc">Admin Email: {{ $adminData->email }}</h6>
                </div>
                <div class="widget-user-image">
                    <img class="rounded-circle"
                        src="{{ !empty($adminData->profile_photo_path) ? url('upload/admin_images/'.$adminData->profile_photo_path) : url('upload/admin_images/blank_profile_photo.jpg') }}"
                        alt="User Avatar">
                </div>

            </div>
        </div>
    </div> --}}

    <div class="page-content page-container" id="page-content">

        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img class="rounded-circle"
                                            src="{{ !empty($adminData->profile_photo_path) ? url('upload/admin_images/'.$adminData->profile_photo_path) : url('upload/admin_images/blank_profile_photo.jpg') }}"
                                            alt="User Avatar">
                                    </div>
                                    <h6 class="f-w-600">Admin Name: {{ $adminData->name }}</h6>
                                    <p>Web Designer</p>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Email</p>
                                                <h6 class="text-muted f-w-400">{{ $adminData->email }}</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Phone</p>
                                                <h6 class="text-muted f-w-400">98979989898</h6>
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Recent</p>
                                                <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">Most Viewed</p>
                                                <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                            </div>
                                        </div>
                                        <div class=" m-t-40 p-b-5 f-w-600">
                                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-info">Edit
                                                Profile</a>
                                        </div>
                                        {{-- <ul class="social-link list-unstyled m-t-40 m-b-10">
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                    data-original-title="facebook" data-abc="true"><i
                                                        class="mdi mdi-facebook feather icon-facebook facebook"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                    data-original-title="twitter" data-abc="true"><i
                                                        class="mdi mdi-twitter feather icon-twitter twitter"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title=""
                                                    data-original-title="instagram" data-abc="true"><i
                                                        class="mdi mdi-instagram feather icon-instagram instagram"
                                                        aria-hidden="true"></i></a></li>

                                        </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>


@endsection