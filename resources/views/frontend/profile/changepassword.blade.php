@extends('dashboard')

@section('userdashboard_content')
<div class="login-box bg-dark ">
    <form action="{{ route('user.update.password') }}" method="post">
        @csrf
        <div class="user-box">
            {{-- <h5>Current Password Field <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="password" name="current_password" class="form-control" required=""
                    data-validation-required-message="This field is required">
                <div class="help-block"></div>
            </div> --}}

            <input type="password" name="current_password" class="" required=""
                data-validation-required-message="This field is required">
            <label class="" for="">Current Password Field <span>*</span></label>

            @error('current_password')
            <span class="alert text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="user-box">
            <input type="password" name="password" class="" required=""
                data-validation-required-message="This field is required">
            <label class="" for="">New Password Input Field <span>*</span></label>

            {{-- <h5>New Password Input Field <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="password" name="password" class="form-control" required=""
                    data-validation-required-message="This field is required">
                <div class="help-block"></div>
            </div> --}}
            @error('password')
            <span class="alert text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="user-box">
            <input type="password" name="password_confirmation class="" required=""
                data-validation-required-message=" This field is required">
            <label class="" for="">Confirm Password Input Field <span>*</span></label>

            {{-- <h5>Confirm Password Input Field <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="password" name="password_confirmation" data-validation-match-match="password"
                    class="form-control" required="">
                <div class="help-block"></div>
            </div> --}}
            @error('password_confirmation')
            <span class="alert text-danger">{{ $message }}</span>
            @enderror
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
</div>
@endsection