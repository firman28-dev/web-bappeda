{{-- @extends('partials.admin.index')
@section('heading')
Data user
@endsection
@section('page')
Data user 
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Input Data user</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="group_id" class="form-label">Role Akses</label>
                            <select 
                                id="group_id" 
                                name="group_id" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4" 
                                required
                                autocomplete="off"
                                autofocus
                            >
                                <option value="" disabled selected>Pilih Role Akses</option>
                                @foreach($group as $data)
                                    <option value="{{ $data->id }}" {{ old('group_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4 d-none" id="operatorField">
                        <div class="form-group">
                            <label for="bidang_id" class="form-label">Bidang</label>
                            <select 
                                id="bidang_id" 
                                name="bidang_id" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4" 
                                autocomplete="off"
                                oninvalid="this.setCustomValidity('Bidang tidak boleh kosong.')"
                                oninput="this.setCustomValidity('')"
                            >
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach($bidang as $data)
                                    <option value="{{ $data->id }}" {{ old('bidang_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bidang_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-group w-100">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan Username"
                                required
                                autocomplete="username"
                                oninvalid="this.setCustomValidity('Username tidak boleh kosong.')"
                                oninput="this.setCustomValidity('')"
                            >
                            @error('username')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-group w-100">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan Password"
                                required
                                autocomplete="new-password"
                                autofocus
                                oninvalid="this.setCustomValidity('Password tidak boleh kosong.')"
                                oninput="this.setCustomValidity('')"
                            >
                            @error('password')
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
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                &nbsp;
                <a href="{{route('user.index')}}" class="btn btn-sm btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
    
@endsection
@section('script')
    <script>

        $(document).ready(function() {
            $('#group_id').select2({
                placeholder: 'Pilih Role Akses',
                allowClear: true
            });
            $('#bidang_id').select2({
                placeholder: 'Pilih Bidang',
                allowClear: true
            });

            const operatorKabkotaField = document.getElementById('operatorField');

            $('#group_id').on('select2:select', function(e) {
                const selectedValue = e.params.data.id;
                console.log(selectedValue);
                
                if (selectedValue === '2') {
                    operatorKabkotaField.classList.add('d-none');
                    $('#bidang_id').prop('required', false);
                } else {
                    operatorKabkotaField.classList.remove('d-none');
                    $('#bidang_id').prop('required', true);
                }
            });
        });
        
        $('#group_id').change(function() {
            $('#password').val("sumbarprov");
            $('#password').prop('readonly', true);
        });
        

    </script>
@endsection --}}

@extends('partials.admin.master')

@section('title', 'User')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>User<h3>
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
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah User </h5>
                </div>
                <div class="card-body add-post">
                    <form class="row needs-validation theme-form" action="{{ route('user.store') }}" method="POST" id="userForm">
                        @csrf
                        <div class="col-lg-6">
                            <label>Role Akses</label>
                            <select class="form-select js-example-basic-single col-sm-12" name="group_id" id="group_id">
                                @foreach($group as $data)
                                    <option value="{{ $data->id }}" {{ old('group_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 d-none" id="operatorField">
                            <label>Bidang</label>
                            <select class="form-select js-example-basic-single col-sm-12" name="bidang_id" id="bidang_id">
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach($bidang as $data)
                                    <option value="{{ $data->id }}" {{ old('bidang_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bidang_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Username</label>
                            <input 
                                class="form-control" 
                                type="text"
                                placeholder="Username"
                                name="username"
                                id="username"
                                autocomplete="username"
                            >
                            @error('username')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Password</label>
                            <input 
                                class="form-control" 
                                type="password"
                                placeholder="Password"
                                name="password"
                                id="password"
                                autocomplete="password"
                            >
                            @error('password')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    
                        <div class="common-flex justify-content-end mt-3">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <a href="{{route('user.index')}}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/custom-add-product4.js') }}"></script>
    <script src="{{ asset('assets/js/bookmark/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-validation/validation.js') }}"></script>

    <script>
       $(document).ready(function() {

            const operatorKabkotaField = document.getElementById('operatorField');

            $('#group_id').on('change', function(e) {
                const selectedValue = $(this).val();
                // console.log(selectedValue);
                
                if (selectedValue === '2') {
                    operatorKabkotaField.classList.add('d-none');
                    $('#bidang_id').prop('required', false);
                } else {
                    operatorKabkotaField.classList.remove('d-none');
                    $('#bidang_id').prop('required', true);
                }
            });

        });
        
        $('#group_id').change(function() {
            $('#password').val("sumbarprov");
            $('#password').prop('readonly', true);
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Untuk semua input dan select
            document.querySelectorAll('input, select').forEach(function(element) {
                element.addEventListener('input', function() {
                    const invalidDiv = this.parentElement.querySelector('.is-invalid');
                    if (invalidDiv) {
                        invalidDiv.remove(); // Hapus pesan error
                    }
                    this.classList.remove('is-invalid'); // Hapus class is-invalid dari input
                });

                element.addEventListener('change', function() {
                    const invalidDiv = this.parentElement.querySelector('.is-invalid');
                    if (invalidDiv) {
                        invalidDiv.remove();
                    }
                    this.classList.remove('is-invalid');
                });
            });
        });

    </script>
@endsection

