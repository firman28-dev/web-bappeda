<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	  <link rel="icon" type="image/png" href="{{ asset('logo/B BAPPEDA.png') }}" sizes="32x32">
    <title>Bappeda - Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/custom/login_new.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    
  
  </head>
  <body>
    <div class="login-container">
      <form method="POST" class="sign-in-form" action="{{ route('login.perform') }}">
        @csrf
        <h2 class="title">Sign In</h2>
        <p>Silahkan masuk dengan akun yang sudah ada</p>
    
        <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" autocomplete="off"
                value="{{ old('username') }}" />
        </div>
    
        {{-- Error spesifik untuk username --}}
      
        <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" autocomplete="off" />
        </div>
    
        <button type="submit" class="login-btn">
            Masuk
        </button>
      </form>
    </div>

    {{-- <script src="{{asset('assets/custom/app.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
      @if ($errors->has('username'))
          toastr.error("{{ $errors->first('username') }}");
      @endif
  
      @if (session('success'))
          toastr.success("{{ session('success') }}");
      @endif
    </script>
  </body>
</html>