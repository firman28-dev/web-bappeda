{{-- @extends('partials.admin.index')
@section('heading')
Berita Bappeda 
@endsection
@section('page')
Berita Bappeda 
@endsection


@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h3>
                    Daftar Berita Bappeda 
                </h3>
            </div>
        </div>
        <div class="card-body">
            <a href="{{route('news.create')}}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="nav-icon fas fa-folder-plus "></i>Tambah
                </button>
            </a>
            <div class="table-responsive mt-3">
                <table id="tableMenu" class="table table-sm table-striped table-row-bordered border rounded">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="w-50px text-center border border-1">No.</th>
                            <th class="w-100px border border-1"></th>
                            <th class="border border-1">Nama Bidang</th>
                            <th class="w-250px border border-1">Judul</th>
                            <th class="border border-1 text-center">Foto</th>
                            <th class="border border-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($news as $item)
                            <tr>
                                <td class="text-center border border-1">{{ $loop->iteration }}</td>
                                <td class="border border-1 text-center">
                                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-icon btn-primary w-35px h-35px mb-sm-0 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                    <button class="btn btn-icon btn-danger w-35px h-35px mb-sm-0 mb-3" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $item->id }}">
                                        <div class="d-flex justify-content-center">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </button>
                                    <div class="modal fade text-start" tabindex="-1" id="confirmDelete{{ $item->id }}">
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">
                                                            Hapus Data
                                                        </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah yakin ingin menghapus data berita?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary rounded-4">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="border border-1">{{ $item->_bidang->label }}</td>
                                <td class="border border-1">{{ $item->title }}</td>
                                <td class="border border-1 text-center">
                                    <img src="{{ asset('uploads/news/' . $item->image) }}" alt="File Image" class="w-50px h-50px">
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

@section('title', 'Berita Bappeda')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Berita Bappeda<h3>
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
                    <li class="breadcrumb-item active">Berita Bappeda</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Berita Bappeda</h5>
        </div>
        <div class="card-body">
            
            <a href="{{route('news.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a>

            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 80px" class="text-center"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start"> <span class="c-o-light f-w-600">Nama Bidang</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Judul</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Kategori</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Foto</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Status</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">ID</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->_bidang->label }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->_category->title ?? '' }}</td>

                                <td class="text-center">
                                    @if ($item->image)
                                        <figure itemprop="associatedMedia" itemscope="">
                                            <a href="{{ asset('uploads/news/' . $item->image) }}" itemprop="contentUrl" data-size="1600x950">
                                                <img class="img-thumbnail img-50" src="{{ asset('uploads/news/' . $item->image) }}" itemprop="thumbnail" alt="Image description">
                                            </a>
                                        </figure>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td class="text-center"> 
                                    <span class="badge {{ $item->_status->id == 4 ? 'badge-light-success' : 'badge-light-danger' }}"> {{ $item->_status->name }}</span>
                                </td>
                                <td class="text-center"> 
                                    <span> {{ $item->id }}</span>
                                </td>
                                <td class="text-center justify-content-center">
                                    <ul class="action text-center justify-content-center">
                                        <li class="edit"> 
                                            <a href="{{route('news.edit', $item->id)}}"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
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
