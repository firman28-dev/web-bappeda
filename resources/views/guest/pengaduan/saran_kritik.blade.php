@extends('partials.guest.index')
@section('content') 
    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Kritik dan Saran
            <span class="span-custom"></span>
        </h1>
    </div>
    

    <div class="content py-6 mb-0 bg-custom-secondary">
        <div class="container mb-10">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>
                            Kritik & Saran
                        </h3>
                    </div>
                </div>
                <div class="card-body ">
                    <p class="lead">
                        Kami sangat menghargai setiap bentuk komunikasi dari Anda. Silakan sampaikan komentar, opini, pertanyaan, masukan, saran, atau pengaduan Anda melalui formulir di bawah ini. Pendapat Anda sangat berarti bagi kami untuk terus meningkatkan kualitas pelayanan.
                    </p>
                     <form action="/kritik-saran" method="POST">
                        @csrf
                        <div class="row">
                       
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Nama (wajib diisi)</label>
                                    <input type="text" class="form-control form-control-solid" id="nama" name="nama" required placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label required">Email (wajib diisi)</label>
                                    <input type="email" class="form-control form-control-solid" id="email" name="email" required placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">Judul (wajib diisi)</label>
                                    <input type="text" class="form-control form-control-solid" id="judul" name="judul" placeholder="Judul">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label required">Pesan Anda (wajib diisi)</label>
                                    <textarea class="form-control form-control-solid" id="pesan" name="pesan" rows="4" required placeholder="Isi Masukan / Saran"></textarea>
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
                                    <input type="text" class="form-control form-control-solid" id="captcha_saran_kritik" name="captcha_saran_kritik" required placeholder="Jawaban Captcha">
                                    @if ($errors->has('captcha_saran_kritik'))
                                        <span class="text-danger">{{ $errors->first('captcha_saran_kritik') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm text-end mt-4">Kirim</button>

                    </form>
                </div>
            </div>

        </div>

        <div class="container mb-10">
            <div class="card rounded-custom bg-about">
                <div class="card-body">
                    <div class="row align-items-center ">
                        <div class="col-lg-5 mb-lg-0 mb-4 flex-column justify-content-center">
                            <div class="d-flex-column lh-lg">
                                <img src="{{asset('assets/img/about-sumbar.png')}}" alt="">
                                {{-- <h1 class="text-white">Tentang BAPPEDA</h1> --}}
                                <div class="d-flex-row align-items-center mt-5">
                                    <i class="fa-solid fa-location-dot text-white me-2"></i>
                                    <span class="fw-bolder text-white fs-5">Lokasi Bappeda Sumbar</span>
                                </div>
                                <span class="text-white fs-5">
                                    Jl. Khatib Sulaiman No.1, Flamboyan Baru, Kec. Padang Barat, Kota Padang, Sumatera Barat Kode Pos 25156
                                </span>
                                <div class="d-flex-row align-items-center mt-5">
                                    <i class="fa-solid fa-phone text-white me-2"></i>
                                    <span class="fw-bolder text-white fs-5">No Telepon</span>
                                </div>
                                <span class="text-white fs-5">
                                    (0751) 7055183
                                </span>
                                <div class="d-flex-row align-items-center mt-5">
                                    <i class="fa-solid fa-envelope text-white me-2"></i>
                                    <span class="fw-bolder text-white fs-5">Email</span>
                                </div>
                                <span class="text-white fs-5">
                                    bappeda@sumbarprov.go.id
                                </span>
                                <div class="d-flex-row align-items-center mt-5">
                                    <i class="fa-solid fa-hashtag text-white me-2"></i>
                                    <span class="fw-bolder text-white fs-5">Ikuti Kami</span>
                                </div>
                                <div class="d-flex flex-row gap-2 mt-2">
                                    <a href="https://www.instagram.com/bappedaprovsumbar" target="_blank">
                                    <img src="{{ asset('assets/icon/IG.svg') }}" alt="">
                                    </a>
                                    <a href="https://www.youtube.com/@bappedaprovsumbar" target="_blank">
                                    <img src="{{ asset('assets/icon/YT.svg') }}" alt="">
                                    </a>
                                    <a href="https://www.facebook.com/p/Bappeda-Provinsi-Sumatera-Barat-100069898355800/" target="_blank">
                                    <img src="{{ asset('assets/icon/FB.svg') }}" alt="">
                                    </a>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-7 ">
                            <iframe class="w-100 h-400px"  style="border-radius: 24px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.2974880739275!2d100.35823437434728!3d-0.9257947990652464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8d07eb04e27%3A0x2cbc1df2cab53ec1!2sBappeda%20Provinsi%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1734580623331!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')

@endsection