

@extends('partials.admin.master')

@section('title', 'Pejabat Bappeda')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data </h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 needs-validation theme-form" action="{{ route('pejabat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 mb-lg-0 mb-2">
                            <label> Nama Pejabat</label>
                            <input 
                                class="form-control" 
                                type="text"
                                placeholder="Nama Pejabat"
                                name="name"
                                id="name"
                                autocomplete="name"
                                required
                            >
                            @error('name')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-2">
                            <label>Posisi Pejabat</label>
                            <select class="form-select js-example-basic-single col-sm-12" name="group_id" id="group_id">
                                {{-- <option value="" disabled selected>Pilih Status</option> --}}
                                @foreach($group as $data)
                                    <option value="{{ $data->id }}" >
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-2">
                            <label>Bidang</label>
                            <select class="form-select js-example-basic-single col-sm-12" name="bidang_id" id="bidang_id">
                                <option value="" selected>Pilih Bidang</option>
                                @foreach($bidang as $data)
                                    <option value="{{ $data->id }}" >
                                        {{ $data->name }}
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
                        <div class="col-lg-6">
                            <label>Unggah Foto</label>
                            <input 
                                class="form-control" 
                                type="file"
                                name="path"
                                id="path"
                                autocomplete="path"
                                accept="image/*"
                                required
                            >
                            @error('path')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                       
                        
                        <div class="common-flex justify-content-end mt-3">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <a href="{{route('pejabat.index')}}" class="btn btn-sm btn-secondary">
                                Kembali
                            </a>
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
@endsection


