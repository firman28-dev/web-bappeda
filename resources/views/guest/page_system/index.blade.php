@extends('partials.guest.index')
@section('content') 

    <div class="container mt-5">
        <div class="card shadow-sm mb-10">
            <div class="card-body">
                <div class="d-flex flex-row align-items-center gap-3">
                    <div class="w-10px h-50px bg-purple" style="border-radius: 25%" ></div>
                    <h1 class="text-center display-6 pb-0">{{$page_system->title}}</h1>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-10">
            <div class="card-body">
                {!! $page_system->description !!}
               
            </div>
        </div>
    </div>

@endsection

@section('script')
    
@endsection