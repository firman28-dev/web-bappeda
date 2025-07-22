@extends('partials.guest.index')
@section('content') 
    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Laporan Pengaduan
            <span class="span-custom"></span>
        </h1>
    </div>
    

    <div class="content py-6 mb-0 bg-custom-secondary">
        <div class="mb-10 mt-20 mt-lg-n15 mt-n15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card rounded-4 shadow-sm hover-elevate-up bg-backdrop2">
                            <div class="card-body">
                                <div class="container text-center">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-xl-4 col-12">
                                            <div>
                                                <img src="{{asset('assets_global/icon_svg/039-bookmark.svg')}}" alt="" class="w-75">
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-12 text-xl-start">
                                            <p class="">
                                                BELUM DITINDAKLANJUTI
                                            </p>
                                            <h1 class="display-6">
                                                {{$total1}}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card rounded-4 shadow-sm hover-elevate-up bg-backdrop2">
                            <div class="card-body">
                                <div class="container text-center">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-xl-4 col-12">
                                            <div>
                                                <img src="{{asset('assets_global/icon_svg/048-search.svg')}}" alt="" class="w-75">
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-12 text-xl-start">
                                            <p class="">
                                                SEDANG DITINDAKLANJUTI
                                            </p>
                                            <h1 class="display-6">
                                                {{$total2}}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card rounded-4 shadow-sm hover-elevate-up bg-backdrop2">
                            <div class="card-body">
                                <div class="container text-center">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-xl-4 col-12">
                                            <div>
                                                <img src="{{asset('assets_global/icon_svg/072-upload.svg')}}" alt="" class="w-75">
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-12 text-xl-start">
                                            <p class="">
                                                SUDAH DITINDAKLANJUTI
                                            </p>
                                            <h1 class="display-6">
                                                {{$total3}}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container mb-20">
            <div class="card rounded-custom">
                <div class="card-header">
                    <div class="card-title">
                        <h1 class="display 6">Daftar Laporan Pengaduan</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="tableMenu" class="table table-striped table-row-bordered border rounded">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th class="w-60px text-center border border-1">No.</th>
                                    <th class="w-100px border border-1">Nama</th>
                                    <th class="w-100px border border-1">Email</th>
                                    <th class="border w-100px border-1">Judul Pengaduan</th>
                                    <th class="border w-100px border-1">Laporan Pengaduan</th>
                                    <th class="text-center w-100px border border-1">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduan as $index => $item)
                                    <tr>
                                        <td class="text-center border border-1">{{ $index + 1 }}</td>
                                        <td class="border border-1">{{ $item['name'] ?? '-' }}</td>
                                        <td class="border border-1">{{ $item['email'] ?? '-' }}</td>
                                        <td class="border border-1">{{ $item['title'] ?? '-' }}</td>
                                        <td class="border border-1">{{ $item['description'] ?? '-' }}</td>
                                        <td class="text-center border border-1">
                                            @if($item['status'] == 1)
                                                <span class="badge bg-danger">Belum Ditindaklanjuti</span>
                                            @elseif($item['status'] == 2)
                                                <span class="badge bg-warning text-dark">Sedang Ditindaklanjuti</span>
                                            @elseif($item['status'] == 3)
                                                <span class="badge bg-success">Sudah Ditindaklanjuti</span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div> --}}
        <div class="container">
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
@endsection