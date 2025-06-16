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
                        <li class="breadcrumb-item active">Edit Berita</li>
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
                        <h4>Edit Data</h4>
                    </div>
                    <div class="card-body add-post">
                        <form class="row needs-validation theme-form" novalidate="" id="pageSystemForm" action="{{ route('op-news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Title</label>
                                        <input class="form-control" type="text" placeholder="Enter Title" name="title" id="title" value="{{$news->title}}">
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
                                        <input class="form-control" type="text" placeholder="Enter Title" value="{{$bidang->name}}" readonly>
                                        <input name="bidang_id" id="bidang_id" value="{{$bidang->id}}" hidden>

                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Kategori Berita</label>
                                        <select class="form-select js-example-basic-single col-sm-12" name="category_id" id="category_id" required>
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach($category as $data)
                                                <option value="{{ $data->id }}" {{ $data->id == $news->category_id ? 'selected' : '' }}>
                                                    {{ $data->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input class="form-control" type="text" placeholder="Enter Title" value="{{$status->name}}" readonly>
                                        <input name="status_id" id="status_id" value="{{$status->id}}" hidden>
                                        
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
                                            <textarea id="description" name="description" class="form-control form-control-solid" rows="10">{!! $news->description !!}</textarea>
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
                                    <a href="{{route('op-news.index')}}" class="btn btn-sm btn-secondary">
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


