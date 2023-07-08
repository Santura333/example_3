<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/img/logo.png') }}">

    {{-- link css assest +bootstrap+ font --}}
    @include('frontend.frontend_layout.body.style')

</head>


<body class="cnt-home">

    <header>
        @include('frontend.frontend_layout.body.header')
    </header>


    @include('frontend.frontend_layout.body.aside')

    {{-- tu section product-page.blade.php --}}
    {{-- mycart_view cung co frontend_contend, nhu the nao thi thuc chat hien thi ra o moi trang la master_layout, va
    noi
    dung cua yield 'frontend_content' se thay doi tuy thuoc vao route dan toi page do
    -lam sao co the thay doi frontend_content linh hoat nhu vay?
    ==>vi: thuc chat khi di chuyen toi 1 route(vd mycart), thi frontend_master se duoc include de hien thi noi dung, còn
    nội dung của frontend_master lại được yield từ chính route đó(vd: mycart)
    + như vậy, khi route mycart, ta sẽ hiển thị frontend_master vvới nội dung là section frontend_conten từ mycary
    + mặt khác, khi route product_page, ta sẽ hiện thị frontend_master với nội dung là section frontend_content từ
    product_page --}}
    @yield('frontend_content')


    <footer>
        @include('frontend.frontend_layout.body.footer')
    </footer>


    @include('frontend.frontend_layout.body.script')


</body>

</html>