@extends('partials.admin.index')
@section('heading')
    Menu Halaman Informasi
@endsection
@section('page')
    Menu Halaman Informasi 
@endsection


@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h3>
                    Daftar Halaman Informasi
                </h3>
            </div>
        </div>
        <div class="card-body">
            <a href="{{route('page-system.create')}}">
                <button type="button" class="btn btn-primary btn-sm">
                    <i class="nav-icon fas fa-folder-plus "></i>Tambah
                </button>
            </a>
            <div class="table-responsive mt-3">
                <table id="tableMenu" class="table table-striped table-row-bordered border rounded">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="w-60px text-center border border-1">No.</th>
                            <th class="w-60px border border-1"></th>
                            <th class="w-200px border border-1">Title</th>
                            <th class="border  w-100px border-1">Foto</th>
                            <th class="text-center w-100px border border-1">Tayang</th>
                            <th class="text-center w-100px border border-1">Status</th>
                            <th class="text-center w-50px border border-1">#ID</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($page_system as $item)
                            <tr>
                                <td class="text-center border border-1">{{ $loop->iteration }}</td>
                                <td class="border border-1 text-center">
                                    <a href="{{ route('page-system.edit', $item->id) }}" class="btn btn-icon btn-primary w-35px h-35px mb-sm-0 mb-3">
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
                                        <form action="{{ route('page-system.destroy', $item->id) }}" method="POST">
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
                                                        <p>Apakah yakin ingin menghapus data?</p>
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
                                <td class="border border-1">{{ $item->title ?? '-' }}</td>
                                <td class="border border-1">
                                    @if ($item->image)
                                        <img src="{{ asset('uploads/page_system/' . $item->image) }}" alt="File Image" class="w-100px h-100px">
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td class="border border-1 text-center">{{ $item->created_at }}</td>
                                <td class="border border-1 text-center">
                                    <div class="badge {{ $item->_status->id == 4 ? 'badge-light-primary' : 'badge-light-danger' }}">
                                    {{ $item->_status->name }}
                                </td>
                                <td class="text-center border border-1">{{ $item->id }}</td>
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
