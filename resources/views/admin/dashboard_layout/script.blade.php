{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
  integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom scripts for all pages-->

<!-- Page level plugins -->
<script src="{{ asset('vendor') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('vendor') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('vendor') }}/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('vendor') }}/chart.js/Chart.min.js"></script>

<script src="{{asset('backend/assets/js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('backend/assets/js/datatables-demo.js')}}"></script>
<!-- Page level plugins -->


<!-- Page level custom scripts -->
<script src="{{asset('backend/assets/js/chart-area-demo.js')}}"></script>
<script src="{{asset('backend/assets/js/chart-pie-demo.js')}}"></script>



{{-- goi tu trang admin.profile.edit --}}
@yield('dashboard_script')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- custom toaster script --}}
<script type="text/javascript">
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

{{-- <script>
  // Make sure jQuery has been loaded
if (typeof jQuery === 'undefined') {
  throw new Error('template requires jQuery')
}

</script> --}}