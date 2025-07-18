
@extends('partials.admin.master')

@section('title', 'Pengajuan Magang')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Pengajuan Magang</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Pengajuan Magang</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Pengajuan Magang</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive custom-scrollbar">
                 <table class="display border table-striped" id="basic-1">
                    <thead>
                        <tr>
                            <th style="width: 80px" class="text-center"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start"> <span class="c-o-light f-w-600">Nama </span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Universitas</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Jurusan</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Hp/WhatsApp</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Email</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Tujuan Magang</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Jadwal Mulai</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Jadwal Berakhir</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Status</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Actions</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($magang as $item)
                             <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name??'' }}</td>
                                <td>{{ $item->universitas ?? '' }}</td>
                                <td>{{ $item->jurusan ?? '' }}</td>
                                <td>{{ $item->phone ?? '' }}</td>
                                <td>{{ $item->email ?? '' }}</td>
                                <td>{{ $item->tujuan ?? '' }}</td>
                                <td>{{ $item->start ? \Carbon\Carbon::parse($item->start)->format('d-m-Y') : 'Belum ada' }}</td>
                                <td>{{ $item->end ? \Carbon\Carbon::parse($item->end)->format('d-m-Y') : 'Belum ada' }}</td>
                                <td></td>
                                <td class="text-center justify-content-center">
                                    <ul class="action text-center justify-content-center">
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('magang.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah yakin ingin menghapus data?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submmit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </td>

                             </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" name="field" id="edit-field">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit <span id="modal-title-field"></span> - <span id="modal-title-indikator"></span> (<span id="modal-title-tahun"></span>)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-value" class="required">Nilai</label>
                                <input type="number" step="0.001" class="form-control" name="value" id="edit-value" required>
                                 <small class="form-text text-muted">
                                    Masukkan nilai dalam angka desimal (contoh: 95.50). Maksimal 100.00.
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/dataTables1.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom2.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable_advance.js') }}"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endsection
