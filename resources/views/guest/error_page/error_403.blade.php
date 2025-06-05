@extends('partials.error_page.master')

@section('title', 'Error 403')

@section('main_content')
    <div class="container">
          <svg> 
            <use href="{{ asset('assets/svg/icon-sprite.svg#error-403') }}"></use>
          </svg>
          <div class="col-md-8 offset-md-2">
            <h3>Forbidden Error</h3>
            <p class="sub-content">Ini adalah halaman 403, Kamu tidak bisa mengakses halaman ini..</p>
          </div>
          <div><a class="btn btn-border-pop btn-primary" href="{{ route('dashboard.index') }}">BACK TO HOME PAGE</a></div>
        </div>
@endsection
