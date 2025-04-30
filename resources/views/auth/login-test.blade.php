<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bappeda - Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/custom/login.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    
  
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" class="sign-in-form" action="{{ route('login.perform') }}">
              @csrf
              <h2 class="title">Log In</h2>
          
              {{-- Tampilkan pesan error umum login --}}
              
          
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
          
              {{-- Error spesifik untuk password --}}
            
          
              <button type="submit" class="btn solid">
                  Masuk
              </button>
          </form>
        

          <form action="" class="sign-up-form">
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" />
            </div>
            <input type="submit" value="Sign Up" class="btn solid" />

            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

        </div>
      </div>
      <div class="panels-container">

        <div class="panel left-panel">
            <div class="content">
                <h3>Silahkan Login</h3>
                <p>Selamat datang di portal resmi Badan Perencanaan Pembangunan Daerah Provinsi Sumatera Barat. Kami berkomitmen untuk mewujudkan perencanaan pembangunan yang transparan, terintegrasi, dan berkelanjutan demi kemajuan daerah.</p>
                {{-- <button class="btn transparent" id="sign-up-btn">Sign Up</button> --}}
            </div>
            <img src="{{asset('assets/img/log.svg')}}" class="image" alt="">
        </div>

        <div class="panel right-panel">
            <div class="content">
                <h3>One of us?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio minus natus est.</p>
                {{-- <button class="btn transparent" id="sign-in-btn">Sign In</button> --}}
            </div>
            <img src="{{asset('assets/img/log.svg')}}" class="image" alt="">
        </div>
      </div>
    </div>


    

    <script src="{{asset('assets/custom/app.js')}}"></script>
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