{{-- @extends('partials.admin.index')
@section('heading')
Halaman Informasi
@endsection
@section('page')
Halaman Informasi
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('page-system.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Input Halaman Informasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="title" class="form-label">Title</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan title"
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
                <a href="{{route('page-system.index')}}" class="btn btn-sm btn-secondary">
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
    </script>
    <script>
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

@section('title', 'Halaman Informasi')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.2.3/dist/quill.imageUploader.min.css" rel="stylesheet"> --}}

@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Halaman Informasi</h3>
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
                        <li class="breadcrumb-item active">Halaman Informasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data</h4>
                    </div>
                    <div class="card-body add-post">
                        <form class="row needs-validation theme-form" novalidate="" id="pageSystemForm" action="{{ route('page-system.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input class="form-control" type="text" placeholder="Enter Title" name="title">
                                        @error('title')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select class="form-select js-example-basic-single col-sm-12" name="status_id" id="status_id">
                                            {{-- <option value="" disabled selected>Pilih Status</option> --}}
                                            @foreach($status as $data)
                                                <option value="{{ $data->id }}" >
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
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
                                            <label class="w-100">Content:</label>
                                            {{-- <textarea id="description" name="description" class="tox-target "></textarea> --}}
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
                                    <a href="{{route('page-system.index')}}" class="btn btn-sm btn-secondary">
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

    
    <!-- Container-fluid Ends-->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img src="{{ asset('assets/images/gif/danger.gif') }}" alt="error"></li>
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
    <!-- calendar js-->
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/bookmark/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-validation/validation.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce/tinymce.min.js') }}"></script>
   
    <script>
        const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/upload-image-information'); 

            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const json = JSON.parse(xhr.responseText);

                        // Cek apakah json.location adalah string
                        if (json.location && typeof json.location === 'string') {
                            resolve(json.location); // ✅ ini harus URL
                        } else {
                            reject('Invalid JSON: "location" is missing or not a string.');
                        }
                    } catch (err) {
                        reject('Invalid JSON response: ' + err.message);
                    }
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
                console.log('File selected:', file);

                const formData = new FormData();
                formData.append('file', file);
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                console.log('CSRF Token:', csrfToken);

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/upload-file-information');
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                xhr.onload = () => {
                    console.log('XHR Status:', xhr.status); 
                    console.log('XHR Response:', xhr.responseText);

                    if (xhr.status >= 200 && xhr.status < 300) {
                        const json = JSON.parse(xhr.responseText);
                        // Menambahkan link ke PDF
                        callback(json.location, { text: file.name });
                    } else {
                        alert('Upload gagal: ' + xhr.status);
                    }
                };
                xhr.onerror = () => {
                    console.error('XHR Error occurred'); 
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
                "help", "image", "insertdatetime", "link", "lists", "media", 
                "preview", "searchreplace", "table", "visualblocks", "code"
            ],
            toolbar: "undo redo | link image | styles | bold italic underline strikethrough | align | bullist numlist | code",
            file_picker_callback: file_upload_handler,
            file_picker_types: 'file image',
            images_file_types: 'jpg,svg,webp,png,jpeg',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
            // images_upload_handler: example_image_upload_handler,
            relative_urls: false,
            convert_urls: false,
            extended_valid_elements: 'iframe[*]',
            valid_children: '+body[iframe]',
            sandbox_iframes: false,
            setup: function (editor) {
                editor.on('SetContent', function () {
                    const iframes = editor.getDoc().querySelectorAll('iframe[sandbox]');
                    iframes.forEach(function (iframe) {
                        iframe.removeAttribute('sandbox');
                    });
                });
            }
        });

       
    </script>
    
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


