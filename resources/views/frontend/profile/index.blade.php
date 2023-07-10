@extends('dashboard')

@section('userdashboard_content')
<div class="login-box bg-dark ">
    <form action="{{ route('user.profile') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="user-box">
            <input type="name" name="name" class="" id="" value={{ $user->name }}>
            <label class="" for="">Name <span>*</span></label>

        </div>
        @error('name')
        <span class="alert text-danger">{{ $message }}</span>
        @enderror
        <div class="user-box">
            <input type="email" name="email" class="" id="" value="{{ $user->email }}">
            <label class="" for="">Email Address <span>*</span></label>
        </div>
        @error('email')
        <span class="alert text-danger">{{ $message }}</span>
        @enderror
        <div class="user-box">
            <input type="text" name="phone_number" class="" id="" value="{{ $user->phone_number }}">
            <label class="" for="">Phone Number <span>*</span></label>
        </div>
        @error('phone_number')
        <span class="alert text-danger">{{ $message }}</span>
        @enderror
        <div class="user-box">
            <p style="color: white;">Profile Picture <span class="text-danger">*</span></p>
            <div class="controls">
                <input type="file" name="image" id="image" class="form-control">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-12 widget-user-image">
            <img id="show-image" class="rounded-circle"
                src="{{ !empty($user->profile_photo_path) ? url('storage/profile-photos/'.$user->profile_photo_path) : url('storage/profile-photos/blank_profile_photo.jpg') }}"
                alt="User Avatar" style="float: right" width="100px" height="100px">
        </div>
        <div class="racing-effect">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button name="submit" type="submit">
                Update Profile
            </button>
        </div>
    </form>

    {{-- <div class="login-box bg-dark">
        <form action="{{ route('user.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="user-box">
                <input type="text" name="username" value="{{ $user->name }}" required="">
                <label>User name </label>
            </div>
            <div class="user-box">
                <input type="phone" name="phone" value="{{ $user->phone_number }}" required="">
                <label>Phone Number </label>
            </div>
            <div class="user-box">
                <input type="email" name="email" value="{{ $user->email }}" required>
                <label for="">Email </label>
            </div>
            <div class="user-box">
                <p style="color: white;">Profile Picture <span class="text-danger">*</span></p>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <a href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <button name="submit" type="submit">
                    Update Profile
                </button>

            </a>
        </form>
    </div> --}}

</div>
@section('frontend_script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#show-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
@endsection