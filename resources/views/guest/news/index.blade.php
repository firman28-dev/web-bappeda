@extends('partials.guest.index')

@section('css')
    <style>
        .custom-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
    </style>
@endsection

@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="text-center display-6 text-white">Berita Bappeda</h1>
        <h1 class="text-center text-white">Bidang {{$bidang->name}}</h1>
        {{-- <h1 class="display-6">{{ $page_system->title }}</h1> --}}
    </div>
    <div class="container mt-10">
        <div class="row mb-10">
            @if ($categoryNews->count() > 0)
                @foreach ($categoryNews as $item)   
                <div class="col-lg-4 mb-10  align-items-stretch">
                    <div class="card h-100 border-0 d-flex flex-column mb-3 custom-card" >
                        <div class="position-relative">
                            @php
                                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                                $extension = strtolower(pathinfo($item->image, PATHINFO_EXTENSION));

                                if (app()->environment('local')) {
                                    $imagePath = public_path('uploads/news/' . $item->image);
                                } else {
                                    $imagePath = base_path('../public_html/uploads/news/' . $dataNews->image);
                                }

                                $imageUrl = (isset($item->image) &&
                                            file_exists($imagePath) &&
                                            in_array($extension, $allowedExtensions))
                                            ? asset('uploads/news/' . $item->image)
                                            : asset('uploads/news/default.jpg');
                            @endphp

                            <img src="{{ $imageUrl }}" class="card-img-top img-hover-zoom" alt="News Image" style="height: 250px; object-fit: cover;">
                    
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
                            <div class="mt-auto">
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
                
                @php
                    $currentPage = $categoryNews->currentPage();
                    $lastPage = $categoryNews->lastPage();
                @endphp

                <ul class="pagination">
                    <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categoryNews->previousPageUrl() }}">
                            &laquo;
                        </a>
                    </li>

                    @for ($i = 1; $i <= $lastPage; $i++)
                        @if ($i == $currentPage)
                            <li class="page-item active"><a class="page-link" href="#">{{ $i }}</a></li>
                        @elseif ($i == 1 || $i == $lastPage || ($i >= $currentPage - 1 && $i <= $currentPage + 1))
                            <li class="page-item"><a class="page-link" href="{{ $categoryNews->url($i) }}">{{ $i }}</a></li>
                        @elseif ($i == 2 && $currentPage > 4)
                            <li class="page-item disabled"><a class="page-link">...</a></li>
                        @elseif ($i == $lastPage - 1 && $currentPage < $lastPage - 3)
                            <li class="page-item disabled"><a class="page-link">...</a></li>
                        @endif
                    @endfor

                    <li class="page-item {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categoryNews->nextPageUrl() }}">
                            &raquo;
                        </a>
                    </li>
                </ul>

            @else
                <div class="text-center">
                    <img src="{{ asset('assets/media/illustration/5-dark.png') }}" alt="" class="w-lg-25 w-sm-50 w-100">
                    <p class="lead">
                        Berita belum tersedia
                    </p>
                </div>
               
            @endif

            
        </div>

        {{-- <div class="d-flex flex-row gap-3 flex-wrap mb-10 justify-content-center">
            @foreach ($allBidang as $item)
                <a href="{{route('guest.get-category',$item->id)}}" class="hover-elevate-down">
                    <div class="card p-3 min-w-200px bg-primary text-white text-center">
                        {{ $item->label }}
                    </div>
                </a>
            @endforeach
        </div> --}}

        <div class="d-flex flex-row gap-3 flex-wrap mb-10 justify-content-center">
            @foreach ($allBidang as $item)
                @php
                    $isActive = isset($currentCategoryId) && $currentCategoryId == $item->id;
                @endphp
                <a href="{{ route('guest.get-category', $item->id) }}" class="hover-elevate-down text-decoration-none">
                    <div class="card p-3 min-w-200px text-center   {{ $isActive ? 'bg-primary text-white border-2 border'  : ' bg-opacity-25 bg-primary text-dark  border-2 border' }}">
                        {{ $item->label }}
                    </div>
                </a>
            @endforeach
        </div>

        

    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
	<script>
    	AOS.init();
  	</script>
@endsection