
@extends('partials.admin.master')

@section('title', 'Sosial Media')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Sosial Media Bappeda</h3>
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

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Sosial Media</h5>
        </div>
        <div class="card-body">
            {{-- <a href="{{route('sosial-media.create')}}" class="btn btn-sm btn-primary mb-3">
                <i class="fa-solid fa-plus pe-1"></i>
                Tambah
            </a> --}}
            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 90px"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start" style="width: 200px"> <span class="c-o-light f-w-600">Platform</span></th>
                            <th> <span class="c-o-light f-w-600">Description</span></th>
                            <th> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                       
                        @foreach ($sosmed as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->platform ?? '-' }}</td>
                                <td>{{ $item->embed_code ?? '-' }}</td>
                                <td class="text-center">
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="{{route('sosial-media.edit', $item->id)}}"><i class="fa-regular fa-pen-to-square"></i>
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

