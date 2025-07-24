@extends('partials.guest.index')
@section('content') 
    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Survey Kepuasan
            <span class="span-custom"></span>
        </h1>
    </div>
    

    <div class="content py-6 mb-0 bg-custom-secondary">
        <div class="container">
            <div class="card d-flex justify-content-center align-items-center">
                <div class="card-body text-center">
                    <p>
                        Sebagai bahan evaluasi kinerja layanan publik Bappeda Provinsi Sumatera Barat, mohon kiranya bapak/ibuk berkenan mengisi
                        kuesioner survei kepuasan layanan diabawah ini
                    </p>
                    <img src="{{ asset('assets_global/media/illustration/chart-graph.png') }}" alt="" class="w-75">
                    <br>
                    <a href="https://s.id/Layanan_Bappeda_SB" target="_blank" class="btn btn-primary">
                        Silahkan Tekan Link ini
                    </a>
                </div>
            </div>

        </div>
    </div>
    
@endsection

@section('script')

@endsection