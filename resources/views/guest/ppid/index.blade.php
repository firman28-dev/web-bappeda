@extends('partials.guest.index')
@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            PPID {{ $nama_kategori }}
            <span class="span-custom"></span>
        </h1>
    </div>
    <div class="content py-6 mb-0 bg-custom-secondary">
        <div class="container mb-20">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display 6">Dokumen PPID</h1>
                    <div class="card rounded-custom">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table id="tableMenu" class="table table-striped table-row-bordered border rounded">
                                    <thead>
                                        <tr class="fw-semibold fs-6 text-muted">
                                            <th class="w-30px text-center border border-1">No.</th>
                                            <th class="w-100px border border-1">Instansi</th>
                                            <th class="border w-100px border-1">Judul</th>
                                            <th class="text-center w-100px border border-1">Tahun</th>
                                            <th class="text-center w-100px border border-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $index => $item)
                                            <tr>
                                                <td class="text-center border border-1">{{ $index + 1 }}</td>
                                                <td class="border border-1">{{ $item['nama_instansi'] ?? '-' }}</td>
                                                <td class="border border-1">{{ $item['title_content'] ?? '-' }}</td>
                                                <td class="text-center border border-1">{{ $item['tahun'] ?? '-' }}</td>
                                                <td class="text-center border border-1">
                                                    <a href="{{$item['downloads1']}}" target="_blank"
                                                        class="btn btn-primary btn-sm">Download</a>
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
                </div>
                <div class="col-lg-4">
                    <h1 class="display 6">Berita Bappeda</h1>
                    @foreach ($news as $item)
                        <div class="col-lg-12 mb-5">
                            <div class="card shadow-sm rounded-4 overflow-hidden mb-4 h-100 border-0 d-flex flex-column mb-3" >
                                <div class="position-relative">
                                    @php
                                        $allowedExtensions = ['png', 'jpg', 'jpeg'];
                                        $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));

                                        // Path fisik ke file gambar
                                        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/news/' . $item->image;

                                        // URL gambar untuk browser
                                        $imageUrl = (isset($item->image) &&
                                                    file_exists($imagePath) &&
                                                    in_array($extension, $allowedExtensions))
                                                    ? asset('uploads/news/' . $item->image)
                                                    : asset('uploads/news/default.jpg');
                                    @endphp
        
                                    <img src="{{ $imageUrl }}" class="card-img-top img-hover-zoom" alt="News Image" style="height: 200px; object-fit: cover;">
                            
                                    <div class="position-absolute top-0 start-0 bg-orange text-white p-2 text-center" style="width: 80px;">
                                        @php
                                            $date = \Carbon\Carbon::parse($item->created_at);
                                        @endphp
                                        <div class="fw-bold fs-6">{{ $date->format('d') }}</div>
                                        <div class="small">{{ $date->format('M') }} {{ $date->format('Y') }}</div>
                                    </div>
                                </div>
                            
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between text-muted small mb-2">
                                        <span><i class="fa-solid fa-eye"></i> {{$item->hits}} Viewers</span>
                                        <span>{{ $item->_user->username ?? ' Admin' }}</span>
                                    </div>
                                
                                    <p class="card-title fw-bold mb-3">
                                        {{ $item->title }}
                                    </p>
                                
                                    <!-- Tombol baca selengkapnya dipaksa ke bawah -->
                                    <div class="mt-auto d-flex justify-content-between">
                                        <span>Bidang: <div class="badge badge-light-danger">{{$item->_bidang->label}}</div></span>
                                        <a href="{{ route('guest.news', $item->id) }}" class="text-decoration-none d-inline-flex align-items-center text-orange fw-semibold">
                                            <span>Baca Selengkapnya</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.146 3.646a.5.5 0 0 1 .708 0L14.207 7.5H1.5a.5.5 0 0 1 0 1h12.707l-3.353 3.854a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.646a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-end mb-3">
                        <a href="{{ route('guest.get-category', $breaking_news->bidang_id) }}" class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-share me-2 fs-4"></i>
                            <span>Lebih banyak berita</span>
                        </a>
                    </div>
                </div>
            </div>
            
           
        </div>
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