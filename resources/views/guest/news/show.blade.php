@extends('partials.guest.index')

@section('content') 

    <div class="container mt-5">
        <div class="card shadow-sm mb-10">
            <div class="card-body">
                <div class="d-flex flex-row align-items-center gap-3">
                    <div class="w-10px h-50px bg-purple" style="border-radius: 25%" ></div>
                    <h1 class="text-center display-6 pb-0">Berita Bappeda</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-2 content-description">
                <div class="card rounded-custom shadow-sm mb-5 border-0">
                    <div class="card-body p-8">
                        <div class="page-content text-custom content-description">
                            @php
                                $content = $news->description;

                                // $content = preg_replace_callback(
                                //     '/<img[^>]+>/i',
                                //     function ($matches) {
                                //         $imgTag = $matches[0];

                                //         $imgTag = preg_replace('/(width|height)="[^"]*"/i', '', $imgTag);

                                //         $imgTag = preg_replace('/<img/i', '<img style="max-width:100%;height:auto;" width="100%"', $imgTag);
                                //         return $imgTag;
                                //     },
                                //     $content
                                // );

                                $content = preg_replace_callback(
                                    '/<img[^>]+src="([^"]+)"[^>]*>/i',
                                    function ($matches) {
                                        $imgSrc = $matches[1];
                                        $newTag = '<a data-fslightbox="gallery" href="' . $imgSrc . '">
                                                        <img src="' . $imgSrc . '" style="max-width:100%;height:auto;" width="100%">
                                                </a>';
                                        return $newTag;
                                    },
                                    $content
                                );

                                $contentWithPdf = preg_replace_callback(
                                    '/<a[^>]+href="([^"]+\.pdf)"[^>]*>.*?<\/a>/i',
                                    function ($matches) {
                                        $pdfUrl = $matches[1];
                                        return '<div class="mb-4">
                                            <iframe src="' . $pdfUrl . '" 
                                                    width="100%" 
                                                    height="800px" 
                                                    frameborder="0" 
                                                    allowfullscreen>
                                            </iframe>
                                        </div>';
                                        // return '<div class="mb-4"><embed src="' . $pdfUrl . '" type="application/pdf" width="100%" height="800px" /></div>';
                                    },
                                    $content
                                );
                            @endphp
                            <h1>{{$news->title}}</h1>
                            <div class="d-flex flex-row justify-content-between">
                                <p >{{$news->formatted_created_at}}</p>
                                <span><i class="fa-solid fa-eye"></i> {{$news->hits}} Viewers</span>
                            </div>
                            {!! $contentWithPdf !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="row">
                    @php
                        $newsAllV2 = $newsAll->take(3);
                    @endphp
                    @foreach ($newsAllV2 as $item)
                        <div class="col-lg-12 mb-5">
                            <div class="card shadow-sm rounded-4 overflow-hidden mb-4 h-100 border-0 d-flex flex-column mb-3" >
                                <div class="position-relative">
                                    {{-- @php
                                        $allowedExtensions = ['png', 'jpg', 'jpeg'];
                                        $imagePath = public_path('uploads/news/' . $item->image);
                                        $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));
                                        $imageUrl = (isset($item->image) &&
                                                    file_exists($imagePath) &&
                                                    in_array($extension, $allowedExtensions))
                                                    ? asset('uploads/news/' . $item->image)
                                                    : asset('uploads/news/default.jpg');
                                    @endphp --}}

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

                            {{-- <div class="card rounded-custom2 shadow-sm" >
                                <div class="card-header p-3">
                                    @php
                                        $allowedExtensions = ['png', 'jpg', 'jpeg'];
                                        $imagePath = public_path('uploads/news/' . $item->image);
                                        $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));

                                        $imageUrl = (isset($item->image) &&
                                                    file_exists($imagePath) &&
                                                    in_array($extension, $allowedExtensions))
                                                    ? asset('uploads/news/' . $item->image)
                                                    : asset('uploads/news/default.jpg');
                                    @endphp

                                    <img src="{{ $imageUrl }}"
                                        alt="File Image"
                                        class="w-100 rounded-custom2"
                                        style="max-height: 150px">
                                </div>
                                <div class="card-body">
                                    <p>
                                        {{ $item->title }}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="flex d-flex flex-row justify-content-between">
                                        <span>Bidang: <div class="badge badge-light-danger">{{$item->_bidang->label}}</div></span>
                                        <a href="{{route('guest.news', $item->id)}}" >
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    @endforeach
                </div>

                @if ($newsAll->count() > 3)
                    <div class="text-end mb-3">
                        <a href="{{ route('guest.get-category', $news->bidang_id) }}" class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-share me-2 fs-4"></i>
                            <span>Lebih banyak berita</span>
                        </a>
                    </div>
                @endif
                {{-- <div class="text-center mt-4">
                    <a href="" class="justify-content-center">Lihat lainnya</a>
                </div> --}}
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/fslightbox/index.js"></script>
    
@endsection