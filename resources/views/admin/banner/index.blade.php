{{-- @extends('partials.admin.index')
@section('heading')
Banner Bappeda 
@endsection
@section('page')
Banner Bappeda 
@endsection


@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h3>
                    Daftar Banner Bappeda 
                </h3>
            </div>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBanner">
                <i class="nav-icon fas fa-folder-plus "></i>Tambah
            </button>
            <div class="modal modal-lg fade text-start" tabindex="-1" id="createBanner" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="{{ route('banner.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title">
                                    Input Banner
                                </h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nama Banner</label>
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Unggah Banner</label>
                                            <input 
                                                type="file" 
                                                name="image" 
                                                class="form-control form-control-solid" 
                                                accept="image/*"
                                                required
                                                autocomplete="image"
                                                id="image"
                                            >
                                            @error('image')
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-4 hover-scale" data-bs-dismiss="modal">Batal</button>
                                &nbsp;
                                <button type="submit" class="btn btn-primary rounded-4 hover-scale">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table id="tableMenu" class="table table-sm table-striped table-row-bordered border rounded">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="w-50px text-center border border-1">No.</th>
                            <th class="w-50px border border-1"></th>
                            <th class="border border-1">Image</th>
                            <th class="border border-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($banner as $item)
                            <tr>
                                <td class="text-center border border-1">{{ $loop->iteration }}</td>
                                <td class="border border-1 text-center">
                                    <button type="button" class="btn btn-icon btn-primary w-35px h-35px mb-sm-0 mb-3" data-bs-toggle="modal" data-bs-target="#createBanner{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <div class="modal modal-lg fade text-start" tabindex="-1" id="createBanner{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form action="{{ route('banner.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">
                                                            Edit Jawaban
                                                        </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="name" class="form-label">Nama Banner</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid rounded rounded-4"
                                                                        placeholder="Masukkan nama menu"
                                                                        required
                                                                        name="name"
                                                                        id="name"
                                                                        autocomplete="name"
                                                                        value="{{$item->name}}"
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
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="image" class="form-label">Unggah Banner</label>
                                                                    <input 
                                                                        type="file" 
                                                                        name="image" 
                                                                        class="form-control form-control-solid" 
                                                                        accept="image/*"
                                                                        required
                                                                        autocomplete="image"
                                                                        id="image"
                                                                    >
                                                                    @error('image')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="status_id2" class="form-label">Status</label>
                                                                    <select 
                                                                        id="status_id2" 
                                                                        name="status_id2" 
                                                                        aria-label="Default select example"
                                                                        class="form-select form-select-solid rounded rounded-4" 
                                                                        required
                                                                        autocomplete="status_id2"
                                                                    >
                                                                        <option value="" disabled selected>Pilih Status</option>
                                                                        @foreach($status as $data)
                                                                            <option value="{{ $data->id }}" {{ $data->id == $item->status_id ? 'selected' : '' }}>
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
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-4 hover-scale" data-bs-dismiss="modal">Batal</button>
                                                        &nbsp;
                                                        <button type="submit" class="btn btn-primary rounded-4 hover-scale">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border border-1">
                                    <img src="{{ asset('uploads/banner/' . $item->image) }}" alt="File Image" class="w-200px h-200px">
                                </td>
                                <td class="border border-1 text-center">
                                    <div class="badge {{ $item->_status->id == 4 ? 'badge-light-primary' : 'badge-light-danger' }}">
                                    {{ $item->_status->name }}
                                </td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
@endsection

@section('script')
    <script>
        
        $("#status_id").select2();
        $("#status_id2").select2();
        $("#tableMenu").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    </script>
@endsection --}}

@extends('partials.admin.master')

@section('title', 'Infografis')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">


@endsection

@section('style')
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

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Infografis</h5>
        </div>
        <div class="card-body">
            <a href="{{route('banner.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a>
            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 90px" class="text-center"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start w-25"> <span class="c-o-light f-w-600">Nama Inforgrafis</span></th>
                            <th class="text-start"> <span class="c-o-light f-w-600">Gambar</span></th>
                            <th class="w-25"> <span class="c-o-light f-w-600 ">Status</span></th>
                            <th> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($banner as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->name }}</td>

                                <td class="text-start">
                                    @if ($item->image)
                                        <figure itemprop="associatedMedia" itemscope="">
                                            <a href="{{ asset('uploads/banner/' . $item->image) }}" itemprop="contentUrl" data-size="1600x950">
                                                <img class="img-thumbnail w-50" src="{{ asset('uploads/banner/' . $item->image) }}" itemprop="thumbnail" alt="Image description">
                                            </a>
                                        </figure>
                                    @else
                                        <p>-</p>
                                    @endif

                                    {{-- <img src="{{ asset('uploads/banner/' . $item->image) }}" alt="File Image" class="w-25"> --}}
                                </td>
                                <td> 
                                    <span class="badge {{ $item->_status->id == 4 ? 'badge-light-success' : 'badge-light-danger' }}"> {{ $item->_status->name }}</span>
                                </td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="{{ route('banner.edit', $item->id) }}"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('banner.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah yakin ingin menghapus data?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submmit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                              
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/dataTables1.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom2.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable_advance.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
@endsection
