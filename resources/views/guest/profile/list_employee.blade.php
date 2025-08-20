@extends('partials.guest.index')
@section('content')

    <div class="bg-content-page py-20 justify-content-center text-center">
        <h1 class="display-6 text-white text-center fw-bold position-relative d-inline-block"
            style="padding-bottom: 0.5rem;">
            Daftar Pegawai Bappeda Sumatera Barat
            <span class="span-custom"></span>
        </h1>
    </div>
    <div class="container p-20">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive bg-white">
                    <table id="tableMenu" class="table table-striped table-row-bordered border" style="width:100%">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th class="w-60px border border-1 ps-4">No</th>
                                <th class="w-100px border border-1 text-center">Foto</th>
                                <th class="w-200px border border-1">Nama Pejabat</th>
                                <th class="w-300px border border-1">Jabatan</th>
                                <th class="border border-1">Bidang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td class="text-center border border-1">{{$loop->iteration}}</td>
                                    <td class="text-center border border-1">
                                        <img src="{{ $item->path ? asset('uploads/pegawai/'.$item->path) : asset('assets_global/img/blank.png') }}" 
                                            class="rounded-circle w-50px h-50px" 
                                            alt="foto pegawai">
                                    </td>
                                    <td class="border border-1">{{$item->nama_pns}}</td>
                                    <td class="border border-1">{{$item->jabatan_nm}}</td>
                                    <td class="border border-1">{{$item->_bidang->name ?? '-'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@endsection

@section('script')
    <script>
        $("#tableMenu").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    </script>
@endsection