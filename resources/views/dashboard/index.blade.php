@extends('partials.admin.index')
@section('heading')
    Dashboard
@endsection
@section('page')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="card w-100 card-custom">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="flex-column">
                            <h3 class="text-custom-primary">
                                TOTAL USER
                            </h3>
                            <h1 class="text-custom-secondary">
                                {{$user}}
                            </h1>
                        </div>
                        <img src="{{asset('assets/img/icon/user-2.svg')}}" alt="" class="mb-4" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 d-flex align-items-stretch mb-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="card w-100 card-custom">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="flex-column">
                            <h3 class="text-custom-primary">
                                TOTAL BIDANG
                            </h3>
                            <h1 class="text-custom-secondary">
                                {{$bidang}}
                            </h1>
                        </div>
                        <img src="{{asset('assets/img/icon/user-2.svg')}}" alt="" class="mb-4" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}", "Berhasil");
        @endif
    </script>
@endsection

