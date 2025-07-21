
@extends('partials.admin.master')

@section('title', 'Permohonan Informasi')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Permohonan Informasi</h3>
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
                    <li class="breadcrumb-item active">Permohonan Informasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Permohonan Informasi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive custom-scrollbar">
                 <table class="display border table-striped" id="basic-1">
                    <thead>
                        <tr>
                            <th style="width: 80px" class="text-center"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start"> <span class="c-o-light f-w-600">Nama </span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Email</span></th>
                            <th class="w-25 text-start"> <span class="c-o-light f-w-600">Instansi</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Deskripsi</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Dokumen</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Status</span></th>
                            <th class="text-center"> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonan as $item)
                             <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->name??'' }}</td>
                                <td>{{ $item->email ?? '' }}</td>
                                <td>{{ $item->instansi ?? '' }}</td>
                                <td>{{ $item->tujuan ?? '' }}</td>
                                @if ($item->path)
                                    <td>
                                        <a href="{{ asset('uploads/permohonan_informasi/'.$item->path) }}" target="_blank" class="btn btn-icon btn-success mb-sm-0 mb-3">
                                            <div class="d-flex justify-content-center">
                                                <i class="fa-solid fa-eye"></i>
                                            </div>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge badge-light-danger">
                                            Belum upload
                                        </span>
                                    </td>
                                @endif
                                <td>
                                    @php
                                        $badgeClass = '';
                                        $statusText = '';

                                        if ($item->status == 1) {
                                            $badgeClass = 'badge-light-info';
                                            $statusText = 'Diajukan';
                                        } elseif ($item->status == 2) {
                                            $badgeClass = 'badge-light-danger';
                                            $statusText = 'Ditolak';
                                        } elseif ($item->status == 3) {
                                            $badgeClass = 'badge-light-success';
                                            $statusText = 'Diterima';
                                        } else {
                                            $badgeClass = 'badge-light-secondary';
                                            $statusText = 'Tidak Diketahui';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="text-center justify-content-center">
                                    <ul class="action text-center justify-content-center">
                                        <li class="edit">
                                            <a href="" data-bs-target="#confirmEdit{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <div class="modal fade text-start"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmEdit{{ $item->id }}">
                                                <form action="{{ route('permohonan-informasi.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Permohonan</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Contoh field yang bisa diedit -->
                                                                <div class="mb-3">
                                                                    <label for="nama_{{ $item->id }}" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" name="name" id="nama_{{ $item->id }}" value="{{ $item->name }}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="email_{{ $item->id }}" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" name="email" id="email_{{ $item->id }}" value="{{ $item->email }}" readonly>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="email_{{ $item->id }}" class="form-label">Perihal</label>
                                                                    <textarea class="form-control" name="tujuan" id="email_{{ $item->id }}" readonly>{{ $item->tujuan }}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="status_{{ $item->id }}" class="form-label">Status</label>
                                                                    <select name="status" id="status_{{ $item->id }}" class="form-control" required>
                                                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Diajukan</option>
                                                                        <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Ditolak</option>
                                                                        <option value="3" {{ $item->status == 3 ? 'selected' : '' }}>Diterima</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                <button type="submmit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST">
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
