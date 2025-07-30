@extends('partials.guest.index')
@section('content') 
    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Permohonan Informasi
            <span class="span-custom"></span>
        </h1>
    </div>
    

    <div class="content py-6 mb-0 bg-custom-secondary">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-pills-custom mb-5 mt-5 justify-content-center">
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-150px h-85px active" 
                                id="kt_stats_widget_16_tab_link_1" 
                                data-bs-toggle="pill" 
                                href="#tab1">
                                <div class="nav-icon mb-3">
                                    <i class="fa-solid fa-file-lines fs-2x"></i>
                                </div>
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1 text-uppercase">Permohonan Informasi</span>
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-orange"></span>
                            </a>
                        </li>
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-150px h-85px" 
                                id="kt_stats_widget_16_tab_link_2" 
                                data-bs-toggle="pill" 
                                href="#tab2">
                                <div class="nav-icon mb-3">
                                    <i class="fa-solid fa-triangle-exclamation fs-2x"></i>
                                </div>
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1 text-uppercase">Pengaduan</span>
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-orange"></span>
                            </a>
                        </li>
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-150px h-85px" 
                                id="kt_stats_widget_16_tab_link_3" 
                                data-bs-toggle="pill" 
                                href="#tab3">
                                <div class="nav-icon mb-3">
                                    <i class="fa-solid fa-user-graduate fs-2x"></i>
                                </div>
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1 text-uppercase">Magang</span>
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-orange"></span>
                            </a>
                        </li>
                        <li class="nav-item mb-3 me-3 me-lg-6">
                            <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-150px h-85px" 
                                id="kt_stats_widget_16_tab_link_4" 
                                data-bs-toggle="pill" 
                                href="#tab4">
                                <div class="nav-icon mb-3">
                                    <i class="fa-solid fa-chart-column fs-2x"></i>
                                </div>
                                <span class="nav-text text-gray-800 fw-bold fs-6 lh-1 text-uppercase">Survey Kepuasan</span>
                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-orange"></span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab1">
                            <h4 class="mb-5">Permohonan Informasi</h4>
                            <form action="/laporan-permohonan-informasi" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label required">Nama</label>
                                            <input type="text" class="form-control form-control-solid" id="name" name="name" required placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label required">Email</label>
                                            <input type="email" class="form-control form-control-solid" id="email" name="email" required placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="instansi" class="form-label required">Instansi/Lembaga/Masyarakat</label>
                                            <input type="text" class="form-control form-control-solid" id="instansi" name="instansi" required placeholder="Instansi"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label required">No HP/WhatsApp</label>
                                            <input type="text" class="form-control form-control-solid" id="phone" name="phone" required placeholder="No Hp/WA">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="tujuan" class="form-label required">Perihal Permohonan Informasi</label>
                                            <textarea class="form-control form-control-solid" id="tujuan" name="tujuan" rows="4" required placeholder="Perihal Permohonan Informasi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Unduh Template Permohonan</label>
                                            <br>
                                            <a href="{{ asset('pelayanan/Form Permohonan Informasi - Bappeda.pdf') }}" class="btn btn-success btn-sm" download>
                                                <i class="fa-solid fa-print"></i>
                                                Unduh Template Permohonan Informasi
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="surat_pengantar" class="form-label required">Upload Surat Permohonan Sesuai Template (PDF)</label>
                                            <input type="file" class="form-control form-control-solid" id="path" name="path" required accept=".pdf">
                                            @if ($errors->has('path'))
                                                <span class="text-danger">{{ $errors->first('path') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $a = rand(1, 10);
                                        $b = rand(1, 10);
                                    @endphp

                                    <input type="hidden" name="a" value="{{ $a }}">
                                    <input type="hidden" name="b" value="{{ $b }}">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="captcha_permohonan" class="form-label required">
                                                Captcha: Berapa {{ $a }} + {{ $b }}?
                                            </label>
                                            <input type="text" class="form-control form-control-solid" id="captcha_permohonan" name="captcha_permohonan" required placeholder="Jawaban Captcha">
                                            @if ($errors->has('captcha_permohonan'))
                                                <span class="text-danger">{{ $errors->first('captcha_permohonan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm text-end">Kirim Permohonan</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <h4>Pengaduan</h4>
                            <form action="/laporan-pengaduan" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label required">Nama</label>
                                            <input type="text" class="form-control form-control-solid" id="name" name="name" required placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label required">Email</label>
                                            <input type="email" class="form-control form-control-solid" id="email" name="email" required placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="instansi" class="form-label required">Instansi/Lembaga/Masyarakat</label>
                                            <input type="text" class="form-control form-control-solid" id="instansi" name="instansi" required placeholder="Instansi"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label required">Judul Pengaduan</label>
                                            <input type="text" class="form-control form-control-solid" id="title" name="title" required placeholder="Judul Pengaduan">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label required">Isi Laporan</label>
                                            <textarea class="form-control form-control-solid" id="description" name="description" rows="4" required placeholder="Isi Masukan / Saran"></textarea>
                                        </div>
                                    </div>
                                    @php
                                        $a = rand(1, 10);
                                        $b = rand(1, 10);
                                    @endphp

                                    <input type="hidden" name="a" value="{{ $a }}">
                                    <input type="hidden" name="b" value="{{ $b }}">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="captcha_pengaduan" class="form-label required">
                                                Captcha: Berapa {{ $a }} + {{ $b }}?
                                            </label>
                                            <input type="text" class="form-control form-control-solid" id="captcha_pengaduan" name="captcha_pengaduan" required placeholder="Jawaban Captcha">
                                            @if ($errors->has('captcha_pengaduan'))
                                                <span class="text-danger">{{ $errors->first('captcha_pengaduan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm text-end">Kirim Permohonan</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <h4>Magang</h4>
                            <form action="/pengajuan-magang" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label required">Nama</label>
                                            <input type="text" class="form-control form-control-solid" id="name" name="name" required placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="universitas" class="form-label required">Universitas</label>
                                            <input type="text" class="form-control form-control-solid" id="universitas" name="universitas" required placeholder="Universitas">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="jurusan" class="form-label required">Jurusan</label>
                                            <input type="text" class="form-control form-control-solid" id="jurusan" name="jurusan" required placeholder="Jurusan"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label required">No HP/WhatsApp (Aktif)</label>
                                            <input type="text" class="form-control form-control-solid" id="phone" name="phone" required placeholder="No HP/WhatsApp"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label required">Email</label>
                                            <input type="email" class="form-control form-control-solid" id="email" name="email" required placeholder="Email"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label required">Jadwal Magang</label>
                                            <input name="time" class="form-control form-control-solid @error('time') is-invalid @enderror"  placeholder="Pilih Waktu" id="time"/>
                                        </div>
                                        @error('time')
                                            <div class="is-invalid">
                                                <span class="text-danger">
                                                    {{$message}}
                                                </span>
                                            </div>
                                        @enderror
                                        <input type="text" name="started_at" id="started_at" hidden/>
                                        <input type="text" name="ended_at" id="ended_at" hidden/>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="surat_pengantar" class="form-label required">Upload Surat Pengantar Magang (PDF) Maksimal 2 MB</label>
                                            <input type="file" class="form-control form-control-solid" id="path" name="path" required accept=".pdf">
                                            @if ($errors->has('path'))
                                                <span class="text-danger">{{ $errors->first('path') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="tujuan" class="form-label required">Tujuan Magang</label>
                                            <textarea class="form-control form-control-solid" id="tujuan" name="tujuan" rows="4" required placeholder="Isi Tujuan Magang"></textarea>
                                        </div>
                                    </div>
                                    @php
                                        $a = rand(1, 10);
                                        $b = rand(1, 10);
                                    @endphp

                                    <input type="hidden" name="a" value="{{ $a }}">
                                    <input type="hidden" name="b" value="{{ $b }}">
                                    
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="captcha_magang" class="form-label required">
                                                Captcha: Berapa {{ $a }} + {{ $b }}?
                                            </label>
                                            <input type="text" class="form-control form-control-solid" id="captcha_magang" name="captcha_magang" required placeholder="Jawaban Captcha">
                                            @if ($errors->has('captcha_magang'))
                                                <span class="text-danger">{{ $errors->first('captcha_magang') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm text-end">Kirim Pengajuan</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <h4>Survey Kepuasan</h4>
                            <img src="{{asset('assets_global/media/illustration/chart-graph.png')}}" alt="" class="w-50">
                            <br>
                            <a href="https://s.id/Layanan_Bappeda_SB" target="_blank" class="btn btn-primary">
                                Silahkan Tekan Link ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
@endsection

@section('script')

@endsection