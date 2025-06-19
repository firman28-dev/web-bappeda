@extends('partials.admin.master')

@section('title', 'Infografis')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.min.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Infografis</h3>
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
                        <li class="breadcrumb-item active">Infografis</li>
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
                        <h5>Edit Infografis </h5>
                    </div>
                    <div class="card-body add-post">
                        <form class="row g-3 needs-validation theme-form" action="{{route('banner.update', $banner->id)}}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Nama Infografis<span>*</span></label>
                                    <input class="form-control" type="text" placeholder="Nama Infografis" name="name"
                                        id="name" autocomplete="name" value="{{$banner->name}}" required>
                                    @error('name')
                                        <div class="is-invalid">
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Unggah Inforgrafis</label>
                                    <input class="form-control" type="file" placeholder="Nama URL" name="image" id="image"
                                        autocomplete="image" accept="image/*">
                                    @error('image')
                                        <div class="is-invalid">
                                            <span class="text-danger">
                                                {{$message}}
                                            </span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Status<span>*</span></label>
                                    <select class="form-select js-example-basic-single col-sm-12" name="status_id"
                                        id="status_id" required>
                                        <option value="" disabled selected>Select Status</option>
                                        @foreach($status as $data)
                                            <option value="{{ $data->id }}" {{ $data->id == $banner->status_id ? 'selected' : '' }}>
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

                            <div class="common-flex justify-content-end mt-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{route('banner.index')}}" class="btn btn-sm btn-secondary">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img src="http://127.0.0.1:8001/assets/images/gif/danger.gif" alt="error"></li>
                        </ul>
                        <h4 class="text-center pb-2">Terjadi Kesalahan Upload</h4>
                        <p class="text-center c-light">Ukuran File yang kamu upload maksimal 3 MB. Silahkan diulangi kembali
                            uploadnya</p>
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
    <script src="{{ asset('assets/js/editors/quill.js') }}"></script>
    <script src="{{ asset('assets/js/custom-add-product4.js') }}"></script>
    <script>
        document.getElementById('image').addEventListener('change', function () {
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