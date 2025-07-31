

@extends('partials.admin.master')

@section('title', 'Pegawai Terbaik')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Pegawai Terbaik</h3>
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
                    <form class="row g-3 needs-validation theme-form" action="{{ route('pegawai-terbaik.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Tahun</label>
                                    <input class="form-control" type="text" name="tahun" id="tahun" readonly value="{{$date}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Bulan</label>
                                    <select name="bulan" id="bulan" class="form-select js-example-basic-single col-sm-12" required>
                                        <option value="">-- Pilih Bulan --</option>
                                        @foreach([
                                            '1' => 'Januari',
                                            '2' => 'Februari',
                                            '3' => 'Maret',
                                            '4' => 'April',
                                            '5' => 'Mei',
                                            '6' => 'Juni',
                                            '7' => 'Juli',
                                            '8' => 'Agustus',
                                            '9' => 'September',
                                            '10' => 'Oktober',
                                            '11' => 'November',
                                            '12' => 'Desember'
                                        ] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Nama Pegawai</label>
                                    <select name="pegawai_id" id="pegawai_id" class="form-select js-example-basic-single col-sm-12" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach($pegawai as $data)
                                            <option value="{{ $data->id }}" >
                                                {{ $data->nama_pns }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                            
                        </div>
                       
                        
                        <div class="common-flex justify-content-end mt-3">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                            <a href="{{route('pegawai-terbaik.index')}}" class="btn btn-sm btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-body"> 
       <div class="modal-toggle-wrapper">  
         <ul class="modal-img">
           <li> <img src="{{asset('assets/images/gif/danger.gif')}}" alt="error"></li>
         </ul>
         <h4 class="text-center pb-2">Terjadi Kesalahan Upload</h4>
         <p class="text-center c-light">Ukuran File yang kamu upload maksimal 3 MB. Silahkan diulangi kembali uploadnya</p>
         <button class="btn btn-secondary d-flex m-auto" type="button" data-bs-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
</div>


@endsection

@section('scripts')
   
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

<script>
    document.getElementById('path').addEventListener('change', function () {
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


