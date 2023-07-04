<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>BakerzBite Admin - Dashboard</title>

    {{-- Style Blade START --}}
    @include('admin.dashboard_layout.style')
    {{-- Style Blade END --}}

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper" id="wrapper">

        <aside class="main-sidebar">
            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.dashboard_layout.aside')
        </aside>

        <header id="content-wrapper" class="d-flex flex-column">
            {{-- Header START --}}
            @include('admin.dashboard_layout.header')
            {{-- Header END --}}

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container-full">
                    @yield('dashboard_content')
                </div>
            </div>
            <!-- /.content-wrapper -->
        </header>



        {{-- Footer START --}}
        {{-- @include('admin.dashboard_layout.footer') --}}
        {{-- Footer END --}}

        <!-- Control Sidebar -->
        {{-- @include('admin.dashboard_layout.sidebar') --}}
        <!-- /.control-sidebar -->

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->

    </div>
    <!-- ./wrapper -->

    {{-- Script Start --}}
    @include('admin.dashboard_layout.script')
    {{-- Script End --}}

</body>

</html>