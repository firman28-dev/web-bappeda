@extends('partials.guest.index')

@section('css')
    
@endsection

@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="text-center display-6 text-white">Bappeda</h1>
        <h1 class="text-center text-white">Bidang {{$bidang->name}}</h1>
        {{-- <h1 class="display-6">{{ $page_system->title }}</h1> --}}
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
	<script>
    	AOS.init();
  	</script>
@endsection