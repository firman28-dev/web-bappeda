@extends('partials.guest.index')
@section('content') 

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Pejabat Struktural 
            <span class="span-custom"></span>
            
        </h1>
        <ul class="breadcrumb breadcrumb-dot m-auto fs-6 fw-semibold justify-content-center">
            <a href="/" class="text-white pe-2">Beranda</a>
            <li class="breadcrumb-item text-white"></li>
            <a href="{{route('guest.pejabat')}}" class="text-white pe-3">Profile</a>
            <li class="breadcrumb-item text-white"></li>
            <span class="text-white">
                {{ $pejabat->name }}
            </span>
        </ul>
    </div>
    <div class="container p-20">
        <div class="row d-flex align-items-center">
            <div class="col-lg-5">
                @if ($pejabat->path)
                    <img src="{{ asset('uploads/pejabat/' . $pejabat->path) }}" class="card-img-top w-75" alt="News Image" style="object-fit: cover;">
                @else
                    <img src="https://kemenpar.go.id/_next/image?url=https%3A%2F%2Fapi.kemenpar.go.id%2Fstorage%2Fapp%2Fuploads%2Fpublic%2F679%2F1ca%2Fb06%2F6791cab06b87e394207864.png&w=1920&q=75" class="card-img-top img-hover-zoom" alt="News Image" style="height: 300px; object-fit: cover;">
                @endif
            </div>
            <div class="col-lg-7">
                <h2 class="section-title">Informasi Pejabat</h2>
                <ul class="contact-info-list">
                    <li>
                        <div class="icon-circle"><i class="fas fa-user text-white"></i></div>
                        <div class="info-text">
                            @if (!$pejabat->subid)
                                <strong>
                                    @if ($pejabat->bidang_id != 5)
                                        {{ $pejabat->_group->ket }}
                                    @endif
                                    {{ $pejabat->_bidang->name ?? '' }}
                                </strong>
                            @else
                                <strong>{{ $pejabat->_group->ket }} {{$pejabat->subid}}</strong>
                            @endif
                            {{ $pejabat->name }}
                        </div>

                    </li>
                    
                    @if (!$pejabat->subid)
                    <li>
                        <div class="icon-circle"><i class="fa-solid fa-graduation-cap text-white"></i></div>
                        <div class="info-text">
                            <strong>Pendidikan S2</strong> {{$pejabat->s2 ?? '-'}}
                        </div>
                    </li>
                    @endif
                    <li>
                        <div class="icon-circle"><i class="fa-solid fa-graduation-cap text-white"></i></div>
                        <div class="info-text">
                            <strong>Pendidikan S1</strong> {{$pejabat->s1 ?? '-'}}
                        </div>
                    </li>
                    <li>
                        <div class="icon-circle"><i class="fas fa-envelope text-white"></i></div>
                        <div class="info-text">
                            <strong>Email</strong> <a href="{{$pejabat->email ?? ''}}">{{$pejabat->email ?? '-'}}</a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        
    </div>

@endsection

@section('script')
<script>
    
</script>
@endsection