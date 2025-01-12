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
            <div class="col-lg-8">
                <h1>{{$news->title}}</h1>
                <p class="text-start">Tanggal Tayang : {{$news->formatted_created_at}}</p>
                {!! $news->description !!}
            </div>
            <div class="col-lg-4">
                <div class="row">
                    @php
                        $newsAllV2 = $newsAll->take(3);
                    @endphp
                    @foreach ($newsAllV2 as $item)
                        <div class="col-lg-12 mb-4">
                            <div class="card rounded-custom2 shadow-sm w-100">
                                <a href="{{route('guest.news', $item->id)}}" class="text-decoration-none text-dark" >
                                    <div class="card-header p-5 justify-content-center">
                                        <img src="{{ asset('uploads/news/' . $item->image) }}" alt="File Image" class="w-100 rounded-custom2" style="max-height: 150px">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-row justify-content-between mb-4">
                                            <div class="badge badge-light-danger">{{$item->_bidang->label}}</div>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y') }}</span>
                                        </div>
                                        <p class="lead">
                                            {{ $item->title }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($newsAll->count() > 3)
                    <div class="text-center mb-3">
                        <a href="{{route('guest.get-category',$news->bidang_id)}}" class="btn btn-primary btn-sm">Lihat Lainnya</a>
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
    
@endsection