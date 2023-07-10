<!-- Topbar Start -->
<div class="container-fluid top-bar bg-dark text-light px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="nav-item nav-link">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-light" href="frontend/layouts"></a></li>
                </ol>

        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn-lg-square text-primary border-end rounded-0" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn-lg-square text-primary border-end rounded-0" href=""><i
                        class="fab fa-linkedin-in"></i></a>
                <a class="btn-lg-square text-primary pe-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="./index.html" class="navbar-brand ms-4 ms-lg-0">
        <img src="{{ asset('frontend/img/Bakerz_logo6_edit-removebg-preview.png') }}" alt="" class="logo">

    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto p-4 p-lg-0">
            <a href="./" class="nav-item nav-link active">Home</a>
            <a href="./products" class="nav-item nav-link">Products</a>
            <a href="/about" class="nav-item nav-link">About</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="./pages/map.html" class="dropdown-item">Site Map</a>
                    <a href="./pages/gallery.html" class="dropdown-item">Gallery</a>
                </div>
            </div>
            <a href="/contact" class="nav-item nav-link">Contact</a>
        </div>
        <div class=" d-none d-lg-flex">
            <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">

                {{-- <a href="tel:+123456789">
                    <i class="fa fa-phone text-primary"></i>
                </a> --}}
                <img class="img-profile rounded-circle"
                    src="{{ !empty($user->profile_photo_path) ? url('storage/profile-photos/'.$user->profile_photo_path) : url('upload/admin_images/blank_profile_photo.jpg') }}"
                    alt="">
            </div>
            <div class="ps-3">

                <small class="text-primary mb-0">Welcome</small>
                {{-- <a class="nav-link " href="#">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user->name }}</span>
                </a> --}}
                {{-- <p class="text-light fs-5 mb-0">+012 345 6789</p> --}}
                <p class="text-light fs-5 mb-0">{{$user->name}}</p>

            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->