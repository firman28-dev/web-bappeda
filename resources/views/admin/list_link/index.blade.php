
@extends('partials.admin.master')

@section('title', 'Link Terkait')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
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

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Link Terkait</h5>
        </div>
        <div class="card-body">
            <a href="{{route('list-link.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a>

            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 90px"> <span class="c-o-light f-w-600">No</span></th>
                            <th> <span class="c-o-light f-w-600">Nama</span></th>
                            <th> <span class="c-o-light f-w-600">Alamat URL</span></th>
                            <th> <span class="c-o-light f-w-600">Gambar</span></th>
                            <th> <span class="c-o-light f-w-600">Deskrispi Link</span></th>
                            <th> <span class="c-o-light f-w-600">Status</span></th>
                            <th> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_link as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name ?? '-' }}</td>
                                <td>{{ $item->url ?? '-' }}</td>
                                <td class="border border-1 text-center">
                                    <img src="{{ asset('uploads/list_link/' . $item->path) }}" alt="File Image" class="img-50">
                                </td>
                                <td>{{ $item->desc ?? '-' }}</td>
                                <td> 
                                    <span class="badge {{ $item->_status->id == 4 ? 'badge-light-success' : 'badge-light-danger' }}"> {{ $item->_status->name }}</span>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="{{ route('list-link.edit', $item->id) }}"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('list-link.destroy', $item->id) }}" method="POST">
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
@endsection
