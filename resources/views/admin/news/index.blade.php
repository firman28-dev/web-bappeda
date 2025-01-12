@extends('partials.admin.index')
@section('heading')
Berita Bappeda 
@endsection
@section('page')
Berita Bappeda 
@endsection


@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h3>
                    Daftar Berita Bappeda 
                </h3>
            </div>
        </div>
        <div class="card-body">
            <a href="{{route('news.create')}}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="nav-icon fas fa-folder-plus "></i>Tambah
                </button>
            </a>
            <div class="table-responsive mt-3">
                <table id="tableMenu" class="table table-sm table-striped table-row-bordered border rounded">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="w-50px text-center border border-1">No.</th>
                            <th class="w-100px border border-1"></th>
                            <th class="border border-1">Nama Bidang</th>
                            <th class="w-250px border border-1">Judul</th>
                            {{-- <th class="border border-1">Body</th> --}}
                            <th class="border border-1 text-center">Foto</th>
                            <th class="border border-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($news as $item)
                            <tr>
                                <td class="text-center border border-1">{{ $loop->iteration }}</td>
                                {{-- <td></td> --}}
                                <td class="border border-1 text-center">
                                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-icon btn-primary w-35px h-35px mb-sm-0 mb-3">
                                        <div class="d-flex justify-content-center">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </div>
                                    </a>
                                    <button class="btn btn-icon btn-danger w-35px h-35px mb-sm-0 mb-3" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $item->id }}">
                                        <div class="d-flex justify-content-center">
                                            <i class="fa-solid fa-trash"></i>
                                        </div>
                                    </button>
                                    <div class="modal fade text-start" tabindex="-1" id="confirmDelete{{ $item->id }}">
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">
                                                            Hapus Data
                                                        </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah yakin ingin menghapus data berita?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary rounded-4">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="border border-1">{{ $item->_bidang->label }}</td>
                                <td class="border border-1">{{ $item->title }}</td>
                                {{-- <td class="border border-1">{!! $item->description !!}</td> --}}
                                <td class="border border-1 text-center">
                                    <img src="{{ asset('uploads/news/' . $item->image) }}" alt="File Image" class="w-50px h-50px">
                                </td>
                                <td class="border border-1 text-center">
                                    <div class="badge {{ $item->_status->id == 4 ? 'badge-light-primary' : 'badge-light-danger' }}">
                                    {{ $item->_status->name }}
                                </td>
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
