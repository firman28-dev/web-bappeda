@extends('partials.guest.index')

@section('css')
    
@endsection

@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            {{$category->title}}
            <span class="span-custom"></span>
        </h1>
    </div>
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-7 col-12">
                {{-- <h2 class="mb-3">Kategory Berita</h2> --}}
                @forelse ($news as $item)
                <div class="card shadow-sm mb-5 hover-elevate-up">
                    <div class="card-body">
                         <div class="row d-flex align-items-center">
                            <div class="col-md-5 col-12">
                                @if ($item->image)
                                    <img src="{{ asset('uploads/news/' . $item->image) }}" class="card-img-top img-hover-zoom" alt="News Image" style="height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('uploads/news/default.jpg') }}" class="card-img-top img-hover-zoom" alt="News Image" style="height:200px; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-7 col-12">
                                @php
                                    $date = \Carbon\Carbon::parse($item->created_at)->format('d M Y');
                                @endphp
                                <h2>{{ $item->title }}</h2>
                                <div class="d-flex align-items-center mt-2 mb-2 text-muted">
                                    <i class="fas fa-calendar px-2"></i>{{ $date }}
                                    <span class="px-2">|</span>
                                    <i class="fas fa-user px-2"></i>{{ $item->created_by ?? 'Admin' }}
                                    <span class="px-2">|</span>
                                    <i class="fa-solid fa-eye px-2"></i>{{ $item->hits ?? '-' }}
                                </div>
                                <a href="{{ route('guest.news', $item->id) }}" class="w-50 btn btn-outline btn-outline-primary rounded-4 btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                @empty
                    <div class="row align-items-center text-center justify-content-center">
                        <img src="{{asset('assets_global/media/illustration/empty-content.png')}}" alt="" class="w-75 text-center">
                        <h4 class="text-muted">Kategori konten belum tersedia.</h4>
                    </div>
                @endforelse
            </div>
            <div class="col-md-1 col-12"></div>
            <div class="col-md-4 col-12">
                <h2 class="mb-3">Berita Terbaru</h2>
                @foreach ($newsAll as $item)
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
                                    {{-- <span>{{ $item->_user->username ?? ' Admin' }}</span> --}}
                                    <span>Admin</span>

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
                    <a href="" class="d-inline-flex align-items-center">
                        <i class="fa-solid fa-share me-2 fs-4"></i>
                        <span>Lebih banyak berita</span>
                    </a>
                </div>
            </div>
        </div>
       
        
    </div>
    

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
	<script>
    	AOS.init();
  	</script>
@endsection