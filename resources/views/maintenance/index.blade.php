@extends('partials.authentication.master')

@section('title', 'Maintenance')

@section('css')
@endsection

@section('main_content')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Maintenance start-->
        <div class="error-wrapper comingsoon-bgimg">
            <div class="container">
                <ul class="maintenance-icons">
                    <li><i class="fa-solid fa-gear"></i></li>
                    <li><i class="fa-solid fa-gear"></i></li>
                    <li><i class="fa-solid fa-gear"></i></li>
                </ul>
                <div class="maintenance-heading">
                    <h2 class="headline">MAINTENANCE</h2>
                </div>
                <h4 class="sub-content">Website Sedang Dalam Pemeliharaan. <br> Kami sedang melakukan pemeliharaan sistem untuk meningkatkan layanan kami. <br>Mohon maaf atas ketidaknyamanannya. Silakan kembali beberapa saat lagi. </h4>
                <div>
                    {{-- <a class="btn btn-primary-gradien btn-lg text-light" href="#">BACK TO HOME PAGE</a> --}}
                </div>
            </div>
        </div>
        <!-- Maintenance end-->
    </div>
@endsection

@section('scripts')
@endsection
