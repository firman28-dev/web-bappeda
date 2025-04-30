<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/custom/custom.css')}}" rel="stylesheet" type="text/css" />
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
    <title>Error-Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Geologica:wght@400;500;600;700;800;900&family=Poppins:wght@400;500&display=swap" rel="stylesheet"/>

</head>
<body class="bg-error-2 justify-content-center">

    <div class="d-flex container justify-content-center text-center">
        <div class="card w-50 rounded-4">
            <div class="card-body d-flex flex-column flex-center">
                <h1>
                    Oops!
                </h1>
                <h4>
                    Kamu tidak bisa mengakses halaman ini.
                </h4>
                <img src="{{asset('assets/media/404-error.png')}}" alt="" class="w-75">
                <a href="{{route('dashboard.index')}}" class="btn btn-outline btn-outline-primary">
                    Kembali ke home
                </a>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
</body>
</html>