<div class="col-md-3">
    {{-- <img class="rounded-circle"
        src="{{ !empty($user->profile_photo_path) ? url('storage/profile-photos/'.$user->profile_photo_path) : url('storage/profile-photos/blank_profile_photo.jpg') }}"
        alt="User Avatar" height="100%" width="100%"> --}}
    {{-- <ul class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{ route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
        <a href="{{ route('user.logout') }}" class="btn btn-primary btn-sm btn-block">Logout</a>
    </ul> --}}

    <div class="container bg-dark" style="border-radius: 10px;">
        <div class="link">
            <div class="text"> <a href="{{ route('dashboard') }}" class="">Home</a>
            </div>
        </div>
        <div class="link">
            <div class="text"><a href="{{ route('user.profile')}}" class="">Profile Update</a></div>
        </div>
        <div class="link">
            <div class="text"><a href="{{ route('user.change.password') }}" class="">Change Password</a></div>
        </div>
        <div class="link">
            <div class="text"><a href="{{ route('user.logout') }}" class="">Logout</a></div>
        </div>
    </div>
</div>

{{-- <script>
    //For Demo only
var links = document.getElementsByClassName('link')
for(var i = 0; i <= links.length; i++)
   addClass(i)


function addClass(id){
   setTimeout(function(){
      if(id > 0) links[id-1].classList.remove('hover')
      links[id].classList.add('hover')
   }, id*750) 
}
</script> --}}