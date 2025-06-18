
@extends('partials.admin.master')

@section('title', 'Sosial Media')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Sosial Media</h3>
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
                        <li class="breadcrumb-item active">Sosial Media</li>
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
                        <form class="row needs-validation theme-form" novalidate="" id="pageSystemForm" action="{{ route('sosial-media.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label>Platform</label>
                                        <input class="form-control" type="text" placeholder="Enter Platform" name="platform">
                                        @error('platform')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="email-wrapper">
                                        <div class="theme-form">
                                            <label class="w-100">Content:</label>
                                            <textarea id="embed_code" name="embed_code" class="form-control form-control-solid"></textarea>
                                            @error('embed_code')
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
                                    <a href="{{route('sosial-media.index')}}" class="btn btn-sm btn-secondary">
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
@endsection

@section('scripts')
    <!-- calendar js-->
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/bookmark/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-validation/validation.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce/tinymce.min.js') }}"></script>
   

    <script>
       
        tinymce.init({
            selector: '#embed_code',
            plugins: 'code',
            toolbar: 'undo redo | code',
            extended_valid_elements: 'script[src|async],blockquote[class|data-instgrm-permalink|data-instgrm-version]',
            valid_children: '+body[script]',
            content_css: false,
            menubar: false,
            content_style: 'body { font-family:Arial; font-size:14px }',
        });


        
    </script>

    

@endsection


