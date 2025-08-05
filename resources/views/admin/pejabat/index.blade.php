
@extends('partials.admin.master')

@section('title', 'Pejabat Bappeda')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Pejabat Bappeda</h3>
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
                    <li class="breadcrumb-item active">Pejabat Bappeda</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Pejabat Bappeda</h5>
        </div>
        <div class="card-body">
            <a href="{{route('pejabat.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a>
            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 90px"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start" style="width: 300px"> <span class="c-o-light f-w-600">Nama Pejabat</span></th>
                            <th> <span class="c-o-light f-w-600">Foto</span></th>
                            <th> <span class="c-o-light f-w-600">Jabatan</span></th>
                            <th> <span class="c-o-light f-w-600">Bidang</span></th>
                            <th> <span class="c-o-light f-w-600">Pendidikan S1</span></th>
                            <th> <span class="c-o-light f-w-600">Pendidikan S2</span></th>
                            <th> <span class="c-o-light f-w-600">Email</span></th>
                            <th> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                       
                        @foreach ($pejabat as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name ?? '-' }}</td>
                                <td>
                                    @if ($item->path)
                                        <figure itemprop="associatedMedia" itemscope="">
                                            <a href="{{ asset('uploads/pejabat/' . $item->path) }}" itemprop="contentUrl" data-size="1600x950">
                                                <img class="img-thumbnail img-50" src="{{ asset('uploads/pejabat/' . $item->path) }}" itemprop="thumbnail" alt="Image description">
                                            </a>
                                        </figure>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td>{{ $item->_group->ket ?? '-' }}</td>
                                <td>{{ $item->_bidang->name ?? '-' }}</td>
                                <td>{{ $item->s1 ?? '-' }}</td>
                                <td>{{ $item->s2 ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="{{route('pejabat.edit', $item->id)}}"><i class="fa-regular fa-pen-to-square"></i>
                                            </a>
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

