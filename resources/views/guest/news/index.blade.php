@extends('partials.guest.index')
@section('content') 

    <div class="container mt-5">
        <h1 class="text-center display-6">Berita Bappeda</h1>
        <h1 class="text-center">Bidang {{$bidang->name}}</h1>

        <div class="row mt-10">
            @foreach ($categoryNews as $item)   
            <div class="col-lg-4 mb-5 align-items-stretch">
                <div class="card rounded-custom2 shadow-sm w-100 h-100">
                    <a href="{{route('guest.news', $item->id)}}" class="text-decoration-none text-dark" >
                        <div class="card-header p-5 justify-content-center">
                            <img src="{{ asset('uploads/news/' . $item->image) }}" alt="File Image" class="w-25 rounded-custom2">
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row justify-content-between mb-4">
                                <div class="badge badge-light-danger">{{$item->_bidang->label}}</div>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('j M Y') }}</span>
                            </div>
                            <p class="lead">
                                {{ $item->title }}
                            </p>
                            {{-- <div class="content">
                                {!! Str::limit($item->description, 1000) !!}
                            </div> --}}
                        </div>
                    </a>
                </div>
            </div>
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