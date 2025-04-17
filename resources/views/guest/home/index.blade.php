@extends('partials.guest.index')
@section('content')
    <div class="curve-bg">
        <video autoplay muted loop class="top-0 h-100 w-100 z-index-1" style="object-fit: cover">
            <source src="{{asset('assets/video/MASJID RAYA.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    {{-- <div class="curve-bg">
        <video autoplay muted loop class="video-bg">
            <source src="{{asset('assets/video/MASJID RAYA.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="svg-curve d-lg-block d-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 350">
                <path fill="#fff" fill-opacity="1" d="M0,192L120,208C240,224,480,256,720,256C960,256,1200,224,1320,208L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"
                ></path>
            </svg>
        </div>
    </div> --}}

    <div data-aos="fade-up"
        data-aos-anchor-placement="bottom-bottom"
        data-aos-duration="1000">
        <div class="container mb-15 mt-20">
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

    </div>

    <div data-aos="fade-up"
        data-aos-duration="2000">
        <div class="container">
            <div class="row align-items-stretch d-flex">
                <div class="col-lg-6">
                    <h1 class="display-6 text-center">Berita Terbaru</h1>
                    @foreach ($news as $item)
                        <div class="card rounded-custom2 shadow-sm w-100 h-100" style="max-height: 500px">
                            <a href="{{route('guest.news', $item->id)}}" class="text-decoration-none text-dark">
                                <div class="card-header p-5 justify-content-center">
                                    <img src="{{ asset('uploads/news/' . $item->image) }}" alt="File Image" class="rounded-custom2 w-100" style="max-height: 150px">
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between mb-4"> 
                                        <div class="badge badge-light-danger">{{$item->_bidang->label}}</div>
                                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y') }}</span>
                                    </div>
                                    <p class="lead">
                                        {{ $item->title }}
                                    </p>
                                    <div class="content">
                                        {!! Str::limit($item->description, 250) !!}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <h1 class="display-6 text-center">Realisasi Bappeda</h1>
                    <div class="card h-100 shadow-sm" style="max-height: 500px">
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
                            {{-- <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-sm-6 col-4">
                                            <h3>Pagu</h3>
                                            <h3>Realisasi</h3>
                                            <h3>Persentase</h3>
                                        </div>
                                        <div class="col-sm-6 col-8">
                                            <h3>Pagu</h3>
                                            <h3>Realisasi</h3>
                                            <h3>Persentase</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('guest.detail-realisai')}}">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                                <i class="fa-solid fa-newspaper fs-2"></i>
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
                                <a href="{{route('guest.get-category',$item->id)}}" class="btn btn-primary btn-sm">Lainnya</a>
                            </div>
                        @endif
                        <div class="row d-flex align-items-stretch">
                            @forelse ($item->_news->slice(0, 3) as $dataNews)
                            <div class="col-lg-4 d-flex align-items-stretch mb-5">
                                <div class="card rounded-custom2 shadow-sm w-100">
                                    <a href="{{route('guest.news', $dataNews->id)}}" class="text-decoration-none text-dark" >
                                        <div class="card-header p-5 justify-content-center">
                                            <img src="{{ asset('uploads/news/' . $dataNews->image) }}" alt="File Image" class="w-100 h-150px rounded-custom2">
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-row justify-content-between mb-4">
                                                <div class="badge badge-light-danger">{{$item->label}}</div>
                                                <span>{{ \Carbon\Carbon::parse($dataNews->created_at)->format('j M Y') }}</span>
                                            </div>
                                            <p class="lead">
                                                {{ $dataNews->title }}
                                                {{-- Bappeda : Lembah Anai butuh flyover antisipasi jatuhnya korban nyawa saat bencana --}}
                                            </p>
                                        </div>

                                    </a>
                                </div>
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
                                <img src="{{asset('assets/icon/no1.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Kerja Pemerintah Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets/icon/no2.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Tata Ruang dan Wilayah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets/icon/no3.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Pembangunan Jangka Panjang Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets/icon/no4.png')}}" alt="">
                                <h3 class="lh-sm">Rencana Pembangunan Jangka Menegah Daerah</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets/icon/no5.png')}}" alt="">
                                <h3 class="lh-sm">Laporan Keterangan Pertanggungjawaban</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-8">
                    <div class="card rounded-custom2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-5 align-items-center">
                                <img src="{{asset('assets/icon/no6.png')}}" alt="">
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
                    <h2 class="display-5 text-custom-warning">3,438</h2>
                    <p class="lead">Jumlah Pengunjung</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning">2,149</h2>
                    <p class="lead">Rata-rata Kunjungan Harian</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning">3,493</h2>
                    <p class="lead">Pengunjung Aktif</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex flex-column justify-content-center text-center">
                    <h2 class="display-5 text-custom-warning">4,230</h2>
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
                <div class="col-xl-3 col-md-6 mb-4 aos-init aos-animate d-flex align-items-stretch" data-aos="fade-up" data-aos-duration="1000">
                    <a href="{{$item->url}}" target="_blank" class="d-flex align-items-stretch">
                        <div class="card w-100 d-flex align-items-center hover-scale">
                            <div class="card-body d-flex align-items-center justify-content-center card-custom">
                                <img src="{{ asset('uploads/list_link/' . $item->path) }}" alt="File Image" class="w-25">
                            </div>
                        </div>
                    </a>
                
                </div>
            
            @endforeach
        </div>
    </div>

    <div class="container mb-20 mt-20">
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
                    console.log(response); // Tampilkan data di console
                    
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
                    console.log(data);
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
                    console.error("Error: ", error);
                    alert("Gagal mengambil data.");
                }
            });
        });
       
        function create3DPieChart(data) {
            am4core.ready(function () {
                am4core.useTheme(am4themes_animated);
                // Membuat chart
                var chart = am4core.create("chartdiv", am4charts.PieChart3D);
                chart.hiddenState.properties.opacity = 0;

                // Menambahkan legenda
                chart.legend = new am4charts.Legend();

                // Masukkan data ke dalam chart
                chart.data = data;
                // chart.innerRadius = 100;

                // Konfigurasi series
                var series = chart.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "value";
                series.dataFields.category = "category";
            });
        }

       
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
	<script>
    	AOS.init();
  	</script>
@endsection

