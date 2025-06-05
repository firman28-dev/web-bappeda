@extends('partials.error_page.master')

@section('title', 'Error 404')

@section('main_content')
    <div class="container">
        <svg>
            <use href="{{ asset('assets/svg/icon-sprite.svg#error-404') }}"></use>
        </svg>
        <div class="col-md-8 offset-md-2">
            <h3>Halaman Tidak Ditemukan</h3>
            <p class="sub-content">Halaman yang Anda cari mungkin tidak tersedia, telah dipindahkan, atau diubah namanya</p>
        </div>
        <div><a class="btn btn-primary btn-lg" href="{{ route('guest.index') }}">KEMBALI KE BERANDA</a></div>
    </div>
@endsection
