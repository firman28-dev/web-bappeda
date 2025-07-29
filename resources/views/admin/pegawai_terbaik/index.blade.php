
@extends('partials.admin.master')

@section('title', 'Pegawai Terbaik')

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
                <h3>Pegawai Terbaik<h3>
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
                    <li class="breadcrumb-item active">Pegawai Terbaik</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Pegawai Terbaik</h5>
        </div>
        
        <div class="card-body">
            <a href="{{route('pegawai-terbaik.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a>
            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>Bulan</th>
                            <th>Foto</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($pegawai as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->_pegawai->nama_pns ?? '-' }}</td>
                                <td>{{ $item->_pegawai->nip ?? '-' }}</td>
                                <td>{{ $item->_pegawai->jabatan_nm ?? '-' }}</td>
                                <td>{{ $item->nama_bulan }}</td>
                                <td class="text-center" id="aniimated-thumbnials" itemscope="">
                                    @if ($item->path)
                                        <figure itemprop="associatedMedia" itemscope="">
                                            <a href="{{ asset('uploads/pegawai_terbaik/' . $item->path) }}" itemprop="contentUrl" data-size="1600x950">
                                                <img class="img-thumbnail w-50" src="{{ asset('uploads/pegawai_terbaik/' . $item->path) }}" itemprop="thumbnail" alt="Image description">
                                            </a>
                                        </figure>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </li>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('pegawai-terbaik.destroy', $item->id) }}" method="POST">
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

<script>
    
</script>

@endsection
