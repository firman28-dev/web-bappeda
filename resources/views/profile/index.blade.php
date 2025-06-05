{{-- @extends('partials.admin.index')

@section('heading')
    Profile
@endsection
@section('page')
    Data Profile
@endsection


@section('content')
<div class="row">

    <div class="card mb-5" id="kt_profile_details_view">
        <div class="card-header cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Profile</h3>
            </div>
            <a href="{{route('user.editProfile')}}" class="btn btn-primary btn-sm align-self-center hover-scale">Edit Profile</a>
        </div>
        <div class="card-body p-9">
            <div class="row">
                <div class="col-lg-4 mb-lg-0 mb-3">
                    <div class="d-flex flex-column">
                        @if ($userFind->photo)
                        <img src="{{ asset('uploads/photo/' . $userFind->photo) }}" alt="Foto Pengguna" class="img-fluid rounded mb-2 text-center" style="max-width: 250px">
                        @else
                            <img src="{{ asset('assets/media/blank.png') }}" alt="default user" class="mb-2 text-center" style="max-width: 250px"/>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row mb-7">
                        <label class="col-lg-3 fw-semibold text-muted">Role Akses</label>
                        <div class="col-lg-9 fv-row">
                            <span class="fw-bold fs-6 text-gray-800">{{$userFind->_group->name ?? 'Belum ada'}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-3 fw-semibold text-muted">Nama</label>
                        <div class="col-lg-9 fv-row">
                            <span class="fw-bold fs-6 text-gray-800">{{$userFind->name ?? 'Belum ada'}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-3 fw-semibold text-muted">Email</label>
                        <div class="col-lg-9 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">{{$userFind->email ?? 'Belum ada'}}</span>
                        </div>
                    </div>
                    <div class="row mb-7">
                        <label class="col-lg-3 fw-semibold text-muted">Username</label>
                        <div class="col-lg-9 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">{{$userFind->username ?? 'Belum ada'}}</span>
                        </div>
                    </div>
                    @if (!is_null($userFind->bidang_id))
                        <div class="row mb-7">
                            <label class="col-lg-3 fw-semibold text-muted">Bidang</label>
                            <div class="col-lg-9 fv-row">
                                <span class="fw-bold fs-6 text-gray-800">{{$userFind->_bidang->name}}</span>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="card">
        <form action="{{route('user.updatePassword')}}" method="POST">
            @csrf
            @method('put')
            <div class="card-header cursor-pointer">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Password</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="new-password-input" class="form-label">Password Baru</label>
                            <div class="input-group mb-5">
                                <input type="password" name="new_password"
                                    class="form-control"
                                    placeholder="Masukkan Confirm Password"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    oninvalid="this.setCustomValidity('Password tidak boleh kosong.')"
                                    oninput="this.setCustomValidity('')"
                                    id="new-password-input"
                                >
                                <span class="input-group-text" onclick="togglePassword('new-password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </span>
                            </div>
                            @error('new_password')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="confirm-password-input" class="form-label">Confirm Password</label>
                            <div class="input-group mb-5">
                                <input type="password" name="confirm_password"
                                    class="form-control"
                                    placeholder="Masukkan Confirm Password"
                                    required
                                    autofocus
                                    autocomplete="off"
                                    oninvalid="this.setCustomValidity('Password tidak boleh kosong.')"
                                    oninput="this.setCustomValidity('')"
                                    id="confirm-password-input"
                                >
                                <span class="input-group-text" onclick="togglePassword('confirm-password')">
                                    <i class="fas fa-eye" id="password-eye"></i>
                                </span>
                            </div>
                            
                            
                            @error('confirm_password')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-outline btn-sm hover-scale">Simpan</button>
            </div>
        </form>
        
    </div>
</div>

@endsection

@section('script')
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id + '-input');
            var eye = document.getElementById(id + '-eye');
            if (input.type === "password") {
                input.type = "text";
                eye.className = "fas fa-eye-slash";
            } else {
                input.type = "password";
                eye.className = "fas fa-eye";
            }
        }
    </script>
@endsection --}}


@extends('partials.admin.master')

@section('title', 'Profile User')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Profile User</h3>
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
                    <li class="breadcrumb-item active">Profile User</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            
            <div class="col-xl-4">
                <div class="card">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title mb-0">My Profile</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#"data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="d-flex">
                                        @if ($userFind->photo)
                                        <img src="{{ asset('uploads/photo/' . $userFind->photo) }}" alt="Foto Pengguna" class="img-70 rounded-circle">
                                        @else
                                            <img src="{{ asset('assets/images/user/user.png') }}" alt="Image" class="img-70 rounded-circle">
                                        @endif


                                        <div class="flex-grow-1">
                                            <h4 class="mb-1">{{$userFind->name ?? 'Belum ada'}}</h4>
                                            <p>{{$userFind->_group->name ?? 'Belum ada'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input class="form-control form-control-sm" type="file" name="image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email-Address</label>
                                <input class="form-control" placeholder="your-email@domain.com" name="email" readonly
                                    value="{{ auth()->user()->email }}">
                                @error('email')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Enter Password" readonly
                                    value="{{ auth()->user()->password }}">
                                @error('password')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-start">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-8 card">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('user.updateProfile') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4 class="card-title mb-0">Edit Profile</h4>
                                <div class="card-options">
                                    <a class="card-options-collapse" href="#"data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Email address<span>*</span></label>
                                    <input 
                                        class="form-control" 
                                        type="email"
                                        placeholder="Email" 
                                        name="email"
                                        value="{{ auth()->user()?->email }}"
                                    >
                                    @error('email')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username<span>*</span></label>
                                    <input 
                                        class="form-control" 
                                        type="username"
                                        placeholder="username" 
                                        name="username"
                                        value="{{ auth()->user()?->username }}"
                                    >
                                    @error('username')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama<span>*</span></label>
                                    <input 
                                        class="form-control" 
                                        type="name"
                                        placeholder="name" 
                                        name="name"
                                        value="{{ auth()->user()?->name }}"
                                    >
                                    @error('name')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-start">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <form action="{{route('user.updatePassword')}}" method="post">
                            @csrf
                            @method('put')
                            <div class="card-header">
                                <h4 class="card-title mb-0">Edit Password</h4>
                                <div class="card-options">
                                    <a class="card-options-collapse" href="#"data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="new-password-input" class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password"
                                                class="form-control"
                                                placeholder="Masukkan Confirm Password"
                                                required
                                                autofocus
                                                autocomplete="off"
                                                oninvalid="this.setCustomValidity('Password tidak boleh kosong.')"
                                                oninput="this.setCustomValidity('')"
                                                id="new-password-input"
                                            >
                                            <span class="input-group-text" onclick="togglePassword('new-password')">
                                                <i class="fas fa-eye" id="password-eye"></i>
                                            </span>
                                        </div>
                                        @error('new_password')
                                            <div class="is-invalid">
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="confirm-password-input" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" name="confirm_password"
                                                class="form-control"
                                                placeholder="Masukkan Confirm Password"
                                                required
                                                autofocus
                                                autocomplete="off"
                                                oninvalid="this.setCustomValidity('Password tidak boleh kosong.')"
                                                oninput="this.setCustomValidity('')"
                                                id="confirm-password-input"
                                            >
                                            <span class="input-group-text" onclick="togglePassword('confirm-password')">
                                                <i class="fas fa-eye" id="password-eye"></i>
                                            </span>
                                        </div>
                                        
                                        
                                        @error('confirm_password')
                                            <div class="is-invalid">
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-footer text-start">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function togglePassword(id) {
        var input = document.getElementById(id + '-input');
        var eye = document.getElementById(id + '-eye');
        if (input.type === "password") {
            input.type = "text";
            eye.className = "fas fa-eye-slash";
        } else {
            input.type = "password";
            eye.className = "fas fa-eye";
        }
    }
</script>
@endsection
