<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->
<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="{{ asset('frontend') }}/assets/js/bootstrap.min.js"></script> --}}

<script src="{{ asset('frontend') }}/assets/js/owl.carousel.min.js"></script>


{{-- thu vien sweet alert, dung o function incrementQuantity tai mycart_view.blade.php --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous"></script>

{{-- custom toastr script --}}
<script>
    @if (Session::has('message'))
    let type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}")
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}")
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}")
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}")
            break;
        default:
            break;
    }
@endif
</script>
@yield('frontend_script')


{{-- dang --}}
{{-- <script src="{{ asset('vendor') }}/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor') }}/owlcarousel/owl.carousel.min.js"></script>
<script src="{{ asset('vendor') }}/jquery-easing/easing.min.js"></script>
<script src="{{ asset('vendor') }}/wow/wow.min.js"></script>
<script src="{{ asset('vendor') }}/waypoints/waypoints.min.js"></script>
<script src="{{ asset('vendor') }}/counterup/counterup.min.js"></script>

<script src="{{ asset('frontend') }}/assets/js/main.js"></script>



{{-- <script src="{{ asset('frontend') }}/assets/js/jquery.easing-1.3.min.js"></script> --}}