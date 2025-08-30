<!DOCTYPE html>
<html lang="en" @if (Route::currentRouteName() == 'rtl_layout') dir="rtl" @endif
@if (Route::currentRouteName() === 'layout_dark') data-theme="dark" @endif>
  <head>
    @include('partials.admin.head')
    @include('partials.admin.css')
  </head>
  <body>
    <div id="loading-overlay" style="display: none; position: fixed; top:0; left:0; width:100%; height:100%; background-color: rgba(255,255,255,0.7); z-index: 9999;">
      <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
          <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
          </div>
          <div class="mt-2 text-center">Memuat data...</div>
      </div>
  </div>

    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

     <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">

      <!-- Page header start -->
      @include('partials.admin.header')
      <!-- Page header end-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">

          <!-- Page sidebar start-->
          @include('partials.admin.sidebar')

          <div class="page-body">
            @yield('main_content')
          </div>
          
          @include('partials.admin.footer')
        </div>
    </div>
    @include('partials.admin.scripts')
    @include('admin.inc.alerts')
    {{-- @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            })
        </script>
    @endif --}}

  </body>
</html>