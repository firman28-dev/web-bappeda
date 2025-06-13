{{-- @extends('partials.admin.index')
@section('heading')
    Berita Bappeda
@endsection
@section('page')
    Berita Bappeda
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Input Berita Bappeda</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="title" class="form-label">Judul Berita</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan nama menu"
                                required
                                name="title"
                                id="title"
                                autocomplete="title"
                            >
                            @error('title')
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
                            <label for="bidang_id" class="form-label">Bidang Bappeda</label>
                            <select 
                                id="bidang_id" 
                                name="bidang_id" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4" 
                                required
                                autocomplete="bidang_id"
                            >
                                <option value="" disabled selected>Pilih Bidang</option>
                                @foreach($bidang as $data)
                                    <option value="{{ $data->id }}" >
                                        {{ $data->label }}
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
                        <div class="form-group">
                            <label for="image" class="form-label">Unggah Foto</label>
                            <input 
                                type="file" 
                                name="image" 
                                class="form-control form-control-solid" 
                                accept="image/*"
                                autocomplete="image"
                                id="image"
                            >
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
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
                   
                    <div class="col-lg-12 mb-4">
                        <div class="form-group">
                            <label for="description" class="form-label">Konten Berita</label>
                            <textarea id="description" name="description" class="form-control form-control-solid" rows="10"></textarea>
                            @error('description')
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
                <a href="{{route('news.index')}}" class="btn btn-sm btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
    
@endsection

@section('script')
    <script>
        $("#bidang_id").select2();
        $("#status_id").select2();
    </script>

    <script src="{{ asset('tinymce/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = 2 * 1024 * 1024; 

            if (file && file.size > maxSize) {
                
                Swal.fire({
                    icon: 'warning',
                    title: 'Ukuran file terlalu besar',
                    text: 'Ukuran maksimal file adalah 2 MB.',
                    confirmButtonText: 'Oke',
                });
                e.target.value = ''; 
            }
        });

        const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/upload-image');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const json = JSON.parse(xhr.responseText);
                    resolve(json.location);
                } else {
                    reject('HTTP Error: ' + xhr.status);
                }
            };

            xhr.onerror = () => {
                reject('Upload failed with status ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });

        tinymce.init({
            selector: '#description',
            plugins: [
                "advlist", "anchor", "autolink", "charmap", "code", "fullscreen", 
                "help", "image", "insertdatetime", "link", "lists", "media", 
                "preview", "searchreplace", "table", "visualblocks", "code"
            ],
            toolbar: "undo redo |link image accordion | styles | bold italic underline strikethrough | align | bullist numlist | code",
            image_title: true,
            file_picker_types: 'image',
            images_file_types: 'jpg,svg,webp,png',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            images_upload_handler: example_image_upload_handler,
        });
    </script>
@endsection --}}

@extends('partials.admin.master')
@section('title', 'Berita Bappeda')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Berita Bappeda</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Berita Bappeda</li>
                        <li class="breadcrumb-item active">Tambah Berita</li>
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
                        <h4>Tambah Data</h4>
                    </div>
                    <div class="card-body add-post">
                        <form class="row needs-validation theme-form" novalidate="" id="pageSystemForm" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input class="form-control" type="text" placeholder="Enter Title" name="title" id="title">
                                        @error('title')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Bidang Bappeda</label>
                                        <select class="form-select js-example-basic-single col-sm-12" name="bidang_id" id="bidang_id">
                                            @foreach($bidang as $data)
                                                <option value="{{ $data->id }}" >
                                                    {{ $data->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Kategori Berita</label>
                                        <select class="form-select js-example-basic-single col-sm-12" name="category_id" id="category_id">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach($category as $data)
                                                <option value="{{ $data->id }}" >
                                                    {{ $data->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="form-select js-example-basic-single col-sm-12" name="status_id" id="status_id">
                                            @foreach($status as $data)
                                                <option value="{{ $data->id }}" >
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Unggah Foto</label>
                                        <input 
                                            class="form-control" 
                                            type="file"
                                            placeholder="Nama URL"
                                            name="image"
                                            id="image"
                                            autocomplete="image"
                                            accept="image/*"
                                        >
                                        @error('image')
                                            <div class="is-invalid">
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <div class="email-wrapper">
                                        <div class="theme-form">
                                            <label class="w-100">Konten</label>
                                            <textarea id="description" name="description" class="form-control form-control-solid" rows="10"></textarea>
                                            @error('description')
                                                <div class="is-invalid">
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="common-flex justify-content-end mt-3">
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                    <a href="{{route('news.index')}}" class="btn btn-sm btn-secondary">
                                        Kembali
                                    </a>
                                </div>
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
    <script src="{{ asset('assets/js/bookmark/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-validation/validation.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce/tinymce.min.js') }}"></script>

    <script>
        const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/upload-image-news'); 
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const json = JSON.parse(xhr.responseText);
                    resolve(json.location);
                } else {
                    reject('HTTP Error: ' + xhr.status);
                }
            };

            xhr.onerror = () => {
                reject('Upload failed with status ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });

        const file_upload_handler = (callback, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');

            if (meta.filetype === 'file') {
                input.setAttribute('accept', '.pdf'); // hanya PDF
            } else if (meta.filetype === 'image') {
                input.setAttribute('accept', 'image/*');
            }

            input.onchange = function () {
                const file = this.files[0];
                const formData = new FormData();
                formData.append('file', file);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/upload-pdf-news');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                xhr.onload = () => {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        const json = JSON.parse(xhr.responseText);
                        // Menambahkan link ke PDF
                        callback(json.location, { text: file.name });
                    } else {
                        alert('Upload gagal: ' + xhr.status);
                    }
                };

                xhr.send(formData);
            };

            input.click();
        };

        tinymce.init({
            selector: '#description',
            license_key: 'gpl',
            plugins: [
                "advlist", "anchor", "autolink", "charmap", "code", "fullscreen",
                "help", "image", "insertdatetime", "link", "lists", "preview",
                "searchreplace", "table", "visualblocks", "code"
            ],
            toolbar: "undo redo | link image | styles | bold italic underline strikethrough | align | bullist numlist | code",
            file_picker_callback: file_upload_handler,
            file_picker_types: 'file image',
            images_file_types: 'jpg,svg,webp,png,jpeg',
            images_upload_handler: example_image_upload_handler,
            relative_urls: false,
            convert_urls: false,

        });

    </script>
@endsection

