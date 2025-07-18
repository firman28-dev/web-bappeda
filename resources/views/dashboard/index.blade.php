{{-- @extends('partials.admin.index')
@section('heading')
    Dashboard
@endsection
@section('page')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="card w-100 card-custom">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="flex-column">
                            <h3 class="text-custom-primary">
                                TOTAL USER
                            </h3>
                            <h1 class="text-custom-secondary">
                                {{$user}}
                            </h1>
                        </div>
                        <img src="{{asset('assets/img/icon/user-2.svg')}}" alt="" class="mb-4" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="card w-100 card-custom">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="flex-column">
                            <h3 class="text-custom-primary">
                                TOTAL BIDANG
                            </h3>
                            <h1 class="text-custom-secondary">
                                {{$bidang}}
                            </h1>
                        </div>
                        <img src="{{asset('assets/img/icon/user-2.svg')}}" alt="" class="mb-4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Berhasil");
        @endif
    </script>
@endsection
 --}}

@extends('partials.admin.master')

@section('title', 'Dahboard')

@section('css')
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid dashboard-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="card o-hidden welcome-card">
                <div class="card-body">
                    <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22">Hello {{ auth()->user()->username ?? 'User' }}
                        <span> 
                            <img src="{{ asset('assets/images/dashboard-3/hand.svg') }}" alt="hand vector">
                        </span>
                    </h4>
                    <p>
                        Mari lakukan penginputan berita ataupun halaman informasi yang berkaitan dengan bappeda
                    </p>
                </div>
                <img class="welcome-img" src="../assets/images/dashboard-3/widget.svg"
                    alt="search image">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card course-box">
                <div class="card-body">
                    <div class="course-widget">
                        <div class="course-icon primary"> 
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#course-1"></use>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-0"> 
                                <span class="counter" >{{$user}}</span>
                            </h4>
                                <span class="f-light">Total User</span>
                                <a class="btn btn-light f-light" href="#">
                                    Lihat User
                                    <span class="ms-2"> 
                                        <svg class="fill-icon f-light">
                                            <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                                        </svg>
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>
                <ul class="square-group">
                    <li class="square-1 warning"></li>
                    <li class="square-1 primary"></li>
                    <li class="square-2 warning1"></li>
                    <li class="square-3 danger"></li>
                    <li class="square-4 light"></li>
                    <li class="square-5 warning"></li>
                    <li class="square-6 success"></li>
                    <li class="square-7 success"></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card course-box">
                <div class="card-body">
                    <div class="course-widget">
                        <div class="course-icon primary"> 
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#course-2"></use>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-0"> 
                                <span class="counter" >{{$bidang}}</span>
                            </h4>
                                <span class="f-light">Total Bidang</span>
                                <a class="btn btn-light f-light" href="#">
                                    Lihat Bidang
                                    <span class="ms-2"> 
                                        <svg class="fill-icon f-light">
                                            <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                                        </svg>
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>
                <ul class="square-group">
                    <li class="square-1 warning"></li>
                    <li class="square-1 primary"></li>
                    <li class="square-2 warning1"></li>
                    <li class="square-3 danger"></li>
                    <li class="square-4 light"></li>
                    <li class="square-5 warning"></li>
                    <li class="square-6 success"></li>
                    <li class="square-7 success"></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card course-box">
                <div class="card-body">
                    <div class="course-widget">
                        <div class="course-icon primary"> 
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-reports"></use>
                            </svg>
                        </div>
                        <div>
                            <h4 class="mb-0"> 
                                <span class="counter" >{{$pengaduan}}</span>
                            </h4>
                                <span class="f-light">Total Pengaduan</span>
                                <a class="btn btn-light f-light" href="#">
                                    Lihat Pengaduan
                                    <span class="ms-2"> 
                                        <svg class="fill-icon f-light">
                                            <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                                        </svg>
                                    </span>
                                </a>
                        </div>
                    </div>
                </div>
                <ul class="square-group">
                    <li class="square-1 warning"></li>
                    <li class="square-1 primary"></li>
                    <li class="square-2 warning1"></li>
                    <li class="square-3 danger"></li>
                    <li class="square-4 light"></li>
                    <li class="square-5 warning"></li>
                    <li class="square-6 success"></li>
                    <li class="square-7 success"></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
