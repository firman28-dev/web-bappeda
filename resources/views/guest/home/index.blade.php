@extends('partials.guest.index')
@section('css')
    <style>
       .carousel-indicators img {
            opacity: 0.7;
            transition: all 0.3s ease-in-out;
            height: 100px;
            object-fit: cover;
            border: 2px solid transparent; /* default no border */
        }

        .carousel-indicators .selected img {
            opacity: 1;
            border: 2px solid #007bff; /* biru terang */
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
            transform: scale(1.05); /* sedikit membesar */
            z-index: 2;
            filter: contrast(1.2) saturate(1.3);
        }

    </style>
@endsection
@section('content')
    {{-- <div class="curve-bg">
        <video autoplay muted loop class="top-0 h-100 w-100 z-index-1" style="object-fit: cover">
            <source src="{{asset('assets/video/MASJID RAYA.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div> --}}
    {{-- <div class="curve-bg"> --}}
        {{-- <video autoplay muted loop class="video-bg">
            <source src="{{asset('assets/video/MASJID RAYA.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="svg-curve d-lg-block d-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 350">
                <path fill="#fff" fill-opacity="1" d="M0,192L120,208C240,224,480,256,720,256C960,256,1200,224,1320,208L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
            </svg>
        </div> --}}
    {{-- </div> --}}
    <div class="bg-home">
        <div class="app-container container">
            <div class="row align-items-center py-lg-0 py-20">
                <div class="col-lg-6">
                    <h1 class="display-2 mb-8 text-white">
                        Sumatera Barat <b class="text-custom-primary">Madani</b> yang Maju dan <b class="text-custom-primary">Berkeadilan</b>
                    </h1>
                </div>
                <div class="col-lg-6">
                    <div class="d-lg-block d-none pt-10 pb-0">
                        <img src="{{asset('assets_global/img/GUB WAGUB.png')}}"  class="img-fluid" alt="" class="w-100" />
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="container app-container justify-content-center mb-10">
        <div class="row row align-items-stretch">
            <div class="col-lg-7 h-100">
                <div class="text-start py-10">
                    <span class="d-inline-block position-relative ms-2 text-center justify-content-center">
                        <span class="d-inline-block mb-2 fs-2tx fw-bold">
                            Berita Sumbar
                        </span>
                        <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                    </span>
                </div>
        
                <div class="card card-custom p-6 d-flex flex-column h-100">
                    <div class="card-body card-body flex-grow-1">
                        @if($news_sumbar->count())
                            <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($news_sumbar as $index => $item)
                                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner" role="listbox">
                                    @foreach($news_sumbar as $index => $item)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ $item->image ? asset('uploads/news/' . $item->image) : asset('uploads/news/default.jpg') }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="{{ $item->title }}">
                                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                                                <h5 class="text-white">{{ $item->title }}</h5>
                                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 100) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Sebelumnya</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Selanjutnya</span>
                                </button>
                            </div>
                            <div class="text-center mt-16">
                                <ol class="carousel-indicators list-inline justify-content-center">
                                    @foreach($news_sumbar as $index => $item)
                                        <li class="list-inline-item mx-1">
                                            <a id="carousel-selector-{{ $index }}"
                                            data-bs-slide-to="{{ $index }}"
                                            data-bs-target="#carouselExampleCaptions"
                                            class="{{ $index == 0 ? 'selected' : '' }}">
                                                <img src="{{ $item->image ? asset('uploads/news/' . $item->image) : asset('uploads/news/default.jpg') }}"
                                                    class="img-fluid border"
                                                    style="width: 100px; height: 60px; object-fit: cover;">
                                            </a>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h4 class="text-muted">Tidak ada berita tersedia untuk kategori ini.</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5 h-100">
                <div class="text-start py-10">
                    <span class="d-inline-block position-relative ms-2 text-center justify-content-center">
                        <span class="d-inline-block mb-2 fs-2tx fw-bold">
                            Media Sosial
                        </span>
                        <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-danger translate rounded"></span>
                    </span>
                </div>
                @if ($socials->count())
                <div class="card card-custom p-6 d-flex flex-column h-100">
                    <div class="card-body card-body flex-grow-1">
                        <ul class="nav nav-tabs mb-3">
                            @foreach ($socials as $social)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab{{ $social->id }}">
                                        {{ ucfirst($social->platform) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content w-100" style="overflow:hidden; max-width: 100%; max-height: 50%">
                            @foreach ($socials as $social)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab{{ $social->id }}">
                                    {!! $social->embed_code !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
        
       
    </div>

    <div class="container app-container justify-content-center pb-10">
        <div class="row d-flex align-items-stretch">
             <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="text-center py-10">
                    <span class="d-inline-block position-relative ms-2 text-center justify-content-center">
                        <span class="d-inline-block mb-2 fs-2tx fw-bold">
                            Indikator Makro
                        </span>
                        <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                    </span>
                </div>
                <div class="row justify-content-center text-center mb-6">
                    <div class="col-12">
                        <form>
                            <select 
                                id="makro" 
                                name="makro" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4 bindMakro" 
                                required
                                autocomplete="makro"
                            >

                                <option value="null" disabled selected>Pilih Indikator</option>
                                
                            </select>
                        </form>
                    

                    </div>
                </div>
                <div id="loading-spinner" class="text-center my-5 load d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    {{-- <p>Memuat grafik...</p> --}}
                </div>
                <div class="card shadow-sm rounded-custom ">
                    <div id="result_makro">
                        <div id="initial_message" class="text-center text-muted py-4">
                            <img src="{{asset('assets_global/media/illustration/search.png')}}" alt="" class="w-25" style="opacity:0.7;">
                            <br>
                            <em>Silakan pilih indikator terlebih dahulu.</em>
                        </div>

                        <div class="card-header d-none g-header">
                            <div class="card-title">
                                <h3 id="nama_data"></h3>
                            </div>
                        </div>
                        <div class="card-body align-items-center d-none g-body">
                            <canvas id="grafikMakroChart" class="p-15"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="text-center py-10">
                    <span class="d-inline-block position-relative ms-2 text-center justify-content-center">
                        <span class="d-inline-block mb-2 fs-2tx fw-bold">
                            Realisasi Bappeda
                        </span>
                        <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                    </span>
                </div>
                <div class="card shadow-sm rounded-custom">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h3>Pagu</h3>
                                    <h3>Realisasi</h3>
                                    <h3>Persentase</h3>
                                </div>
                                
                                <div class="col-sm-8">
                                    <h3 id="totalPagu"></h3>
                                    <h3 id="realisasiKeuangan"></h3>
                                    <h3 id="persenKeuangan"></h3>
                                </div>
                            </div>
                            <div id="chartdiv" class="h-300px"></div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{route('guest.detail-realisai')}}">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
       
        
       
        
        
    </div>
    
    <div class="container app-container bg-white p-20">
        <div class="row align-items-center ">
            <div class="col-lg-6 mb-lg-0 mb-4 flex-column justify-content-center">
                <h1 class="display-5">BADAN PERENCANAAN PEMBANGUNAN DAERAH <span class="text-custom-warning">SUMATERA BARAT</span> </h1>
                <p class="lead">
                    Bappeda Sumatera Barat adalah singkatan dari Badan Perencanaan Pembangunan Daerah Provinsi Sumatera Barat. Ini adalah sebuah lembaga pemerintah daerah yang memiliki peran sangat penting dalam perencanaan dan pembangunan di wilayah <span></span> Sumatera Barat.
                </p>
            </div>
            <div class="col-lg-6">
                <iframe class="w-100 h-350px"  src="https://www.youtube.com/embed/Vc8G8tO6rpg?si=Sde0JI15IN5KQCee" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="border-radius: 24px"></iframe>
            </div>
        </div>
    </div>


    {{-- <div data-aos="fade-up"
        data-aos-duration="2000">
        <div class="container">
            <div class="row align-items-stretch d-flex ">
                <div class="col-lg-6 mb-lg-0 mb-15">
                    <h1 class="display-6 text-center mb-2">Berita Terbaru</h1>
                    @if ($latest_news)
                        @php
                            $allowedExtensions = ['png', 'jpg', 'jpeg'];
                            $imagePath = public_path('uploads/news/' . $latest_news->image);
                            $extension = strtolower(pathinfo($latest_news->image, PATHINFO_EXTENSION));
                            $imageUrl = (isset($latest_news->image) &&
                                        file_exists($imagePath) &&
                                        in_array($extension, $allowedExtensions))
                                        ? asset('uploads/news/' . $latest_news->image)
                                        : asset('uploads/news/default.jpg');
                            $date = \Carbon\Carbon::parse($latest_news->created_at);
                            preg_match('/<img[^>]+src="([^">]+)"/', $latest_news->description, $matches);
                            $firstImage = $matches[1] ?? null;
                            $plainText = strip_tags($latest_news->description);
                            $shortText = Str::limit($plainText, 300);
                        @endphp

                        <div class="card shadow-sm overflow-hidden h-100 border-0 rounded-custom mb-7">
                            <div class="position-relative">
                                <img src="{{ $imageUrl }}" class="card-img-top img-hover-zoom" alt="News Image" style="height: 250px; object-fit: cover;">
                                <div class="position-absolute top-0 start-0 bg-orange text-white p-2 text-center" style="width: 60px;">
                                    <div class="fw-bold fs-6">{{ $date->format('d') }}</div>
                                    <div class="small">{{ $date->format('M') }}</div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between text-muted small mb-2">
                                    <span><i class="fa-solid fa-eye"></i> {{ $latest_news->hits ?? '0' }} Viewers</span>
                                    <span>{{ $latest_news->_user->username ?? 'Admin' }}</span>
                                </div>
                                <p class="card-title fw-bold mb-3">
                                    {{ $latest_news->title }}
                                </p>
                                @if ($firstImage)
                                    <img src="{{ $firstImage }}" alt="Gambar" class="img-fluid mb-3" style="max-height: 200px; object-fit: cover;">
                                @endif

                                <div class="content">
                                    {{ $shortText }}
                                </div>          
                                <div class="mt-auto">
                                    <a href="{{ route('guest.news', $latest_news->id) }}" class="text-decoration-none d-inline-flex align-items-center text-orange fw-semibold">
                                        <span>Baca Selengkapnya</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10.146 3.646a.5.5 0 0 1 .708 0L14.207 7.5H1.5a.5.5 0 0 1 0 1h12.707l-3.353 3.854a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.646a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-lg-6">
                    <div>
                        <h1 class="display-6 text-center mb-2">Realisasi Bappeda</h1>
                    </div>
                    <div class="card h-100 shadow-sm rounded-custom">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h3>Pagu</h3>
                                        <h3>Realisasi</h3>
                                        <h3>Persentase</h3>
                                    </div>
                                    
                                    <div class="col-sm-8">
                                        <h3 id="totalPagu"></h3>
                                        <h3 id="realisasiKeuangan"></h3>
                                        <h3 id="persenKeuangan"></h3>
                                    </div>
                                </div>
                                <div id="chartdiv" class="h-300px"></div>

                            </div>
                           
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('guest.detail-realisai')}}">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="container mb-20 mt-20">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-6 text-center">Berita BAPPEDA</h1>
                <ul class="nav nav-pills nav-pills-custom mb-5 mt-5 justify-content-center">
                    
                    @foreach($bidang as $item)
                    <li class="nav-item mb-3 me-3 me-lg-6">
                        <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-100px h-85px pt-5 pb-2 {{ $loop->first ? 'active' : '' }}" 
                            id="kt_stats_widget_16_tab_link_{{ $item->id }}" 
                            data-bs-toggle="pill" 
                            href="#news_{{ $item->id }}">
                            <div class="nav-icon mb-3">
                                <i class="{{ $item->icon ?? 'fa-solid fa-newspaper' }} fs-2"></i>
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1 text-uppercase">{{ $item->label }}</span>
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-orange"></span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($bidang as $item)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="news_{{ $item->id }}">
                        @if ($item->_news->count() > 3)
                            <div class="text-end mb-3">
                                <a href="{{ route('guest.get-category', $item->id) }}" class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-share me-2 fs-4"></i>
                                    <span>Lebih banyak berita</span>
                                </a>
                            </div>
                        @endif
                        <div class="row d-flex align-items-stretch mb-4">
                            @forelse ($item->_news->slice(0, 3) as $dataNews)
                            <div class="col-lg-4 d-flex align-items-stretch mb-5">
                                
                                <div class="card shadow-sm rounded-4 overflow-hidden mb-4 h-100 border-0 d-flex flex-column mb-3 w-100" >
                                    <div class="position-relative">
                                        @php
                                            $allowedExtensions = ['png', 'jpg', 'jpeg'];
                                            $imagePath = public_path('uploads/news/' . $dataNews->image);
                                            $extension = strtolower(pathinfo($dataNews->image, PATHINFO_EXTENSION));
                                            $imageUrl = (isset($dataNews->image) &&
                                                        file_exists($imagePath) &&
                                                        in_array($extension, $allowedExtensions))
                                                        ? asset('uploads/news/' . $dataNews->image)
                                                        : asset('uploads/news/default.jpg');
                                        @endphp
            
                                        <img src="{{ $imageUrl }}" class="card-img-top img-hover-zoom" alt="News Image" style="height: 200px; object-fit: cover;">
                                
                                        <div class="position-absolute top-0 start-0 bg-orange text-white p-2 text-center" style="width: 80px;">
                                            @php
                                                $date = \Carbon\Carbon::parse($dataNews->created_at);
                                            @endphp
                                            <div class="fw-bold fs-6">{{ $date->format('d') }}</div>
                                            <div class="small">{{ $date->format('M') }} {{ $date->format('Y') }}</div>
                                        </div>
                                    </div>
                                
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between text-muted small mb-2">
                                            <span><i class="fa-solid fa-eye"></i> {{$dataNews->hits}} Viewers</span>
                                            <span>{{ $dataNews->_user->username ?? ' Admin' }}</span>
                                        </div>
                                    
                                        <p class="card-title fw-bold mb-3">
                                            {{ $dataNews->title }}
                                        </p>
                                    
                                        <!-- Tombol baca selengkapnya dipaksa ke bawah -->
                                        <div class="mt-auto">
                                            <a href="{{ route('guest.news', $dataNews->id) }}" class="text-decoration-none d-inline-flex align-items-center text-orange fw-semibold">
                                                <span>Baca Selengkapnya</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right ms-2" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.146 3.646a.5.5 0 0 1 .708 0L14.207 7.5H1.5a.5.5 0 0 1 0 1h12.707l-3.353 3.854a.5.5 0 0 1-.708-.708L13.293 8l-3.147-3.646a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                                {{-- <div class="card rounded-custom2 shadow-sm w-100">
                                    <a href="{{route('guest.news', $dataNews->id)}}" class="text-decoration-none text-dark" >
                                        <div class="card-header p-5 justify-content-center">
                                            @php
                                            $imagePath = public_path('uploads/news/' . $dataNews->image);
                                            $imageUrl = ($dataNews->image && file_exists($imagePath))
                                                        ? asset('uploads/news/' . $dataNews->image)
                                                        : asset('uploads/news/default.jpg');
                                        @endphp
                                        
                                        <img src="{{ $imageUrl }}" alt="File Image" class="w-100 h-150px rounded-custom2">
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-row justify-content-between mb-4">
                                                <div class="badge badge-light-danger">{{$item->label}}</div>
                                                <span>{{ \Carbon\Carbon::parse($dataNews->created_at)->format('j M Y') }}</span>
                                            </div>
                                            <p>
                                                {{ $dataNews->title }}
                                            </p>
                                        </div>

                                    </a>
                                </div> --}}
                            </div>
                            @empty
                                <p class="text-muted text-center">Belum ada berita untuk bidang ini.</p>
                            @endforelse
                        </div>
                        
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div id="kt_carousel_3_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h1 class="display-6 text-center">Infografis BAPPEDA</h1>

                        
                        <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                            @foreach ($banner as $key => $item)
                                <li data-bs-target="#kt_carousel_3_carousel" data-bs-slide-to="{{ $key }}" class="ms-1 {{ $key == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="carousel-inner pt-8">
                        @foreach ($banner as $key => $item)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('uploads/banner/' . $item->image) }}" class="d-block w-100" alt="{{ $item->name ?? 'Banner image' }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>

    <div class="mb-20 mt-20 bg-document-public py-20">
        <div class="container">
            <h1 class="display-6 pb-10">Dokumen Publik</h1>
            <div class="row align-items-stretch">
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no1.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Kerja Pemerintah Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no2.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Tata Ruang dan Wilayah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no3.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Pembangunan Jangka Panjang Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no4.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Pembangunan Jangka Menegah Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no5.png')}}" alt="">
                                <h3 class="lh-sm">Laporan Keterangan Pertanggungjawaban</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets_global/icon/no6.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Pembangunan Jangka Panjang Nasional</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-20 mt-20">
        
        <h1 class="display-6 pb-10 text-center">Statistik Pengunjung</h1>
        <div class="row">
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning" data-kt-countup="true" data-kt-countup-value="{{ $jumlahPengunjung }}">0</h2>
                    <p class="lead">Jumlah Pengunjung</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning" data-kt-countup="true" data-kt-countup-value="{{ number_format($rataKunjunganHarian) }}">0</h2>
                    <p class="lead">Rata-rata Kunjungan Harian</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning" data-kt-countup="true" data-kt-countup-value="{{ number_format($pengunjungAktif) }}">0</h2>
                    <p class="lead">Pengunjung Aktif</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning" data-kt-countup="true" data-kt-countup-value="{{ number_format($jumlahHalamanDikunjungi) }}">0</h2>
                    <p class="lead">Jumlah Halaman Dikunjungi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-20 mt-20">
        <h1 class="display-6 pb-10 text-center">Link Terkait</h1>
        <div class="row text-center">
            
            {{-- <h1 class="display-6 pb-10">Link Terkait</h1> --}}
            {{-- <span class="d-inline-block position-absolute h-8px bottom-0 end-0 start-0 bg-primary translate rounded"></span> --}}
            @foreach ($list_link as $item)
                <div class="col-xl-4 col-md-6 mb-4 aos-init aos-animate d-flex align-items-stretch" data-aos="fade-up" data-aos-duration="1000">
                    <a href="{{$item->url}}" target="_blank" class="d-flex align-items-stretch w-100">
                        <div class="card w-100 d-flex align-items-center shadow-sm">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <img src="{{ asset('uploads/list_link/' . $item->path) }}" alt="File Image" class="w-50">
                            </div>
                        </div>
                    </a>
                
                </div>
            
            @endforeach
        </div>
    </div>


     {{-- <div class="container mb-20 mt-20">
        <h1 class="display-6 pb-10 text-center">FAQ BAPPEDA SUMBAR</h1>
        <div class="card">
            <div class="card-body">
                <div class="accordion" id="kt_accordion_1">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="kt_accordion_1_header_{{ $index }}">
                                <button class="accordion-button fs-4 fw-semibold collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#kt_accordion_1_body_{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="kt_accordion_1_body_{{ $index }}">
                                    {{ $faq->name }}
                                </button>
                            </h2>
                            <div id="kt_accordion_1_body_{{ $index }}"
                                class="accordion-collapse collapse"
                                aria-labelledby="kt_accordion_1_header_{{ $index }}"
                                data-bs-parent="#kt_accordion_1">
                                <div class="accordion-body">
                                    {!! $faq->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        

    </div> --}}
    
    <div class="container mb-20 mt-20">
        <div class="card rounded-custom bg-about">
            <div class="card-body">
                <div class="row align-items-center ">
                    <div class="col-lg-5 mb-lg-0 mb-4 flex-column justify-content-center">
                        <div class="d-flex-column lh-lg">
                            <img src="{{asset('assets/img/about-sumbar.png')}}" alt="">
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
                                <img src="{{ asset('assets_global/icon/IG.svg') }}" alt="">
                                </a>
                                <a href="https://www.youtube.com/channel/UCiNbXpt0Z60fK6qOwxE1B0A" target="_blank">
                                <img src="{{ asset('assets_global/icon/YT.svg') }}" alt="">
                                </a>
                                <a href="https://www.facebook.com/p/Bappeda-Provinsi-Sumatera-Barat-100069898355800/" target="_blank">
                                <img src="{{ asset('assets_global/icon/FB.svg') }}" alt="">
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
    

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            const url = "https://admin-dashboard.sumbarprov.go.id/api/simbangda/getrealisasikegiatanopd/72/2024";
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // console.log(response); 
                    
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", error);
                    alert("Gagal mengambil data.");
                }
            }); 
        });
    </script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        $(document).ready(function () {
            const url = "https://simbangda.sumbarprov.go.id/integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/72?tahun=2024";
            // const url = "https://admin-dashboard.sumbarprov.go.id/api/simbangda/getrealisasikegiatanopd/72/2024";
            // console.log(url);

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(number);
            }
            
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    
                    // console.log(response); 
                    const data = response.pencapaian_opd;
                    // console.log(data);
                    const pagu = data.pagu;
                    const realisasiKeuangan = data.rp_realisasi_keuangan;
                    const persenKeuangan = data.persen_realisasi_keuangan;
                    
                    document.getElementById('totalPagu').textContent = ': ' + formatRupiah(pagu);
                    document.getElementById('realisasiKeuangan').textContent = ': ' + formatRupiah(realisasiKeuangan);
                    document.getElementById('persenKeuangan').textContent = ': ' + persenKeuangan + ' %';

                    
                    const chartData = [
                        {
                            category: "Pagu",
                            value: data.pagu
                        },
                        {
                            category: "Realisasi",
                            value: data.rp_realisasi_keuangan
                        },
                    ];
                    create3DPieChart(chartData);

                   
                },
                error: function (xhr, status, error) {
                    // console.error("Error: ", error);
                    alert("Gagal mengambil data.");
                }
            });
        });

        function create3DPieChart(data) {
            am4core.ready(function () {
                am4core.useTheme(am4themes_animated);

                var chart = am4core.create("chartdiv", am4charts.PieChart3D);
                chart.hiddenState.properties.opacity = 0;

                chart.legend = new am4charts.Legend();

                chart.data = data;

                chart.colors.list = [
                    am4core.color("#F29F58"), 
                    am4core.color("#AB4459"), 
                ];

                var series = chart.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "value";
                series.dataFields.category = "category";

                // Pastikan tidak override oleh auto-colors
                series.colors.list = chart.colors.list;
                series.colors.step = 1;
            });
        }


        document.querySelectorAll('[id^="carousel-selector-"]').forEach(function (el) {
            el.addEventListener('click', function () {
                // Hapus semua yang selected
                document.querySelectorAll('[id^="carousel-selector-"]').forEach(e => e.classList.remove('selected'));
                // Tambahkan selected ke yang diklik
                el.classList.add('selected');

                const slideIndex = el.getAttribute('data-bs-slide-to');
                const carousel = bootstrap.Carousel.getOrCreateInstance(document.querySelector('#carouselExampleCaptions'));
                carousel.to(slideIndex);
            });
        });

        const carousel = document.querySelector('#carouselExampleCaptions');
        const indicators = document.querySelectorAll('.carousel-indicators a');

        // Saat slide berubah (manual atau otomatis)
        carousel.addEventListener('slide.bs.carousel', function (e) {
            indicators.forEach((indicator, index) => {
                if (index === e.to) {
                    indicator.classList.add('selected');
                } else {
                    indicator.classList.remove('selected');
                }
            });
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
	<script>
    	AOS.init();
  	</script>
    <script>
        $('#makro').select2({
            placeholder: 'Pilih Indikator',
            allowClear: true
        });

        $(document).ready(function() {
            // Ambil data list makro
            $.ajax({
                type: "GET",
                url: "{{ url('/makro/list_makro') }}",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $.each(data, function(index, value) {
                            let o = new Option(value.nama_indikator, value.id_indikator);
                            $('#makro').append(o);
                        });
                    } else {
                        alert("Data tidak tersedia!");
                    }
                }
            });

            // EVENT CHANGE: Saat user memilih indikator
            $('.bindMakro').on('change', function () {
                var id = $('#makro').val();

                if (id === 'null') {
                    $('#result_makro').html("Indikator Makro Belum dipilih");
                } else {
                    $('.load').removeClass('d-none');

                    $.getJSON("/makro/grafik/" + id + "?jenis=grafik", function (response) {
                        $('.load').removeClass('d-none');


                        const tahun = response.tahun;
                        const dataDaerah = response.data[0];
                        const dataNasional = response.nasional[0];

                        const nilaiDaerah = tahun.map(th => parseFloat(dataDaerah[th]) || 0);
                        const nilaiNasional = dataNasional ? tahun.map(th => parseFloat(dataNasional[th]) || 0) : tahun.map(() => 0);
                        $('#initial_message').hide();
                        $('.card-header').removeClass('d-none');
                        $('.card-body').removeClass('d-none');
                        
                        $('#error_message').remove();
                        $('#nama_data').text(response.nama_data);

                        // Buat ulang canvas (reset chart)
                        $('#grafikMakroChart').remove(); // hapus lama
                        $('#result_makro').append('<canvas id="grafikMakroChart"></canvas>'); // buat baru

                        const ctx = document.getElementById('grafikMakroChart').getContext('2d');

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: response.tahun,
                                datasets: [
                                    {
                                        label: 'Provinsi',
                                        data: nilaiDaerah,
                                        fill: true,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        tension: 0.4,
                                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                        pointRadius: 5
                                    },
                                    {
                                        label: 'Nasional',
                                        data: nilaiNasional,
                                        fill: true,
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        tension: 0.4,
                                        pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                                        pointRadius: 5
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: false,
                                        title: {
                                            display: true,
                                            text: 'Nilai'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Tahun'
                                        }
                                    }
                                }
                            }
                        });

                        $('.load').addClass('d-none');

                    }).fail(function () {
                        $('.load').addClass('d-none');
                        $('#initial_message').hide();
                        $('#grafikMakroChart').remove();
                        $('#nama_data').text('');
                        $('.g-header').addClass('d-none');
                        $('.g-body').addClass('d-none');

                        if ($('#error_message').length === 0) {
                            $('#result_makro').append(`
                                <div id="error_message" class="text-center mt-4 mb-4">
                                    <img src="{{asset('assets_global/media/illustration/search.png')}}" alt="Data tidak tersedia" class='w-25' style="opacity:0.7;">
                                    <br>
                                    <em class="text-danger mt-3">Data Grafik tidak tersedia.</em>
                                </div>
                            `);
                        }
                    });
                }
            });

        });
    </script>
    <script async src="//www.instagram.com/embed.js"></script>
@endsection

