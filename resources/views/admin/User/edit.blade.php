@extends('admin.admin_master')

@section('dashboard_content')
{{-- @include('admin.dashboard_layout.breadcrumb', [
'name' => 'Category',
'url' => "categories.index",
'section_name' => 'Edit Category'
]) --}}
<section class="content">
    <div class="row">
        {{-- Add Category Page --}}
        <div class="col-md-8 col-lg-8 offset-2">
            <div class="box">
                <div class="box-header with-border d-flex justify-content-between align-items-center">
                    <h3 class="box-title">Update User11</h3>
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Back To List User</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                </div>
                <div>
                    <form action="{{ route('user.update', $userEdit)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{-- <input type="hidden" name="id" value="{{ $user->id }}"> --}}
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                            <input type="name" name="name" class="form-control unicase-form-control text-input"
                                id="exampleInputEmail1" value={{ $userEdit->name }}>
                        </div>
                        @error('name')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                            <input type="email" name="email" class="form-control unicase-form-control text-input"
                                id="exampleInputEmail1" value="{{ $userEdit->email }}">
                        </div>
                        @error('email')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
                            <input type="text" name="phone_number" class="form-control unicase-form-control text-input"
                                id="exampleInputEmail1" value="{{ $userEdit->phone_number }}">
                        </div>
                        @error('phone_number')
                        <span class="alert text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <h5>Profile Picture <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="image" id="image" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-12 widget-user-image">
                            <img id="show-image" class="rounded-circle"
                                src="{{ !empty($userEdit->profile_photo_path) ? url('storage/profile-photos/'.$userEdit->profile_photo_path) : url('storage/profile-photos/blank_profile_photo.jpg') }}"
                                alt="User Avatar" style="float: right" width="100px" height="100px">
                        </div>
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection