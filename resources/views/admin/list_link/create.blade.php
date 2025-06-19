{{-- @extends('partials.admin.index')
@section('heading')
    Link Terkait
@endsection
@section('page')
    Data Link Terkait
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('list-link.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Input Data Link Terkait</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Link</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan nama menu"
                                required
                                name="name"
                                id="name"
                                autocomplete="name"
                            >
                            @error('name')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="url" class="form-label">Alamat URL</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan alamat url"
                                required
                                name="url"
                                id="url"
                                autocomplete="url"
                            >
                            @error('url')
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
                            <label for="path" class="form-label">Unggah Logo</label>
                            <input 
                                type="file" 
                                name="path" 
                                class="form-control form-control-solid" 
                                accept="image/*"
                                required
                                autocomplete="path"
                                id="path"
                            >
                            @error('path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="status_id" class="form-label">Status</label>
                            <select 
                                id="status_id" 
                                name="status_id" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4" 
                                required
                                autocomplete="status_id"
                            >
                                <option value="" disabled selected>Pilih Status</option>
                                @foreach($status as $data)
                                    <option value="{{ $data->id }}" >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
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
                <a href="{{route('list-link.index')}}" class="btn btn-sm btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
    
@endsection

@section('script')
    <script>
        $("#status_id").select2();
    </script>
@endsection --}}

@extends('partials.admin.master')

@section('title', 'Link Terkait')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">

@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Link Terkait</h3>
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
                    <li class="breadcrumb-item active">Link Terkait</li>
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
                    <h5>Tambah Link Terkait </h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation theme-form" action="{{ route('list-link.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6">
                            <label> Nama Link</label>
                            <input 
                                class="form-control" 
                                type="text"
                                placeholder="Nama Link"
                                name="name"
                                id="name"
                                autocomplete="name"
                                required
                            >
                            @error('name')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Alamat URL</label>
                            <input 
                                class="form-control" 
                                type="text"
                                placeholder="Nama URL"
                                name="url"
                                id="url"
                                autocomplete="url"
                                required
                            >
                            @error('url')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Status</label>
                            <select class="form-select js-example-basic-single col-sm-12" name="status_id" id="status_id" required>
                                <option value="" disabled selected>Pilih Status</option>
                                @foreach($status as $data)
                                    <option value="{{ $data->id }}" >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('status_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label>Unggah Logo</label>
                            <input 
                                class="form-control" 
                                type="file"
                                placeholder="Nama URL"
                                name="path"
                                id="path"
                                autocomplete="url"
                                accept="image/*"
                                required
                            >
                            @error('path')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="common-flex justify-content-end mt-3">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <a href="{{route('list-link.index')}}" class="btn btn-sm btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Toast Notification -->
<div class="card-body common-flex common-toasts">
    <div class="toast-container position-fixed top-0 end-0 p-3 toast-index toast-rtl">
        <div class="toast" id="liveToast4" role="alert" aria-live="polite" aria-atomic="true">
            <div class="common-space alert-light-danger">
                <div class="toast-body">
                    <i class="close-search stroke-danger" data-feather="x-circle"></i>Ukuran file tidak boleh lebih dari 3 MB.
                </div>
            <button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-body"> 
       <div class="modal-toggle-wrapper">  
         <ul class="modal-img">
           <li> <img src="http://127.0.0.1:8001/assets/images/gif/danger.gif" alt="error"></li>
         </ul>
         <h4 class="text-center pb-2">Terjadi Kesalahan Upload</h4>
         <p class="text-center c-light">Ukuran File yang kamu upload maksimal 3 MB. Silahkan diulangi kembali uploadnya</p>
         <button class="btn btn-secondary d-flex m-auto" type="button" data-bs-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
</div>



@endsection

@section('scripts')
   
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>


<script>
    document.getElementById('path').addEventListener('change', function () {
        const file = this.files[0];
        const maxSize = 3 * 1024 * 1024; // 3 MB

        if (file && file.size > maxSize) {
            this.value = ''; // reset input

            const modalElement = document.getElementById('exampleModalCenter1');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    });
</script>

@endsection


