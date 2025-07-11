<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website BAPPEDA Sumatera Barat adalah website yang memperlihatkan informasi publik">
    <meta name="keywords" content="website bappeda">
    <meta name="author" content="pixelstrap">
	<link rel="icon" type="image/png" href="{{ asset('logo/B BAPPEDA.png') }}" sizes="32x32">
    <title>@yield('title') | Bappeda - Sumatera Barat</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    @include('partials.error_page.css')
</head>
<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="error-wrapper">
            @yield('main_content')
        </div>
    </div>
    <!-- page-wrapper Ends-->

    <!-- Scripts Starts-->
    @include('partials.error_page.script')
    <!-- Scripts Ends-->

</body>

</html>
