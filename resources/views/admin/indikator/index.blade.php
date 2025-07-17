
@extends('partials.admin.master')

@section('title', 'Indikator Makro')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Indikator Makro</h3>
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
                    <li class="breadcrumb-item active">Indikator Makro</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Indikator Makro</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive custom-scrollbar">
                 <table class="display border table-striped" id="basic-6">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 200px">Nama Indikator</th>
                            <th rowspan="2" style="width: 200px">Satuan</th>
                            @foreach ($tahun as $th)
                                <th colspan="3" class="text-center">{{ $th }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @for ($i = 1; $i <=6; $i++)
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>Nasional</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indikator as $item)
                            <tr>
                                <td>{{ $item->indikator_name }}</td>
                                <td class="text-center">{{ $item->satuan }}</td>

                                @foreach ($tahun as $th)
                                    @php
                                        $key = $item->id . '_' . $th;
                                        $data = $nilai[$key][0] ?? null;
                                        $decimalPlaces = ($item->id == 5) ? 3 : 2;
                                    @endphp
                                    <td>
                                        {{ $data?->target !== null ? number_format($data->target, $decimalPlaces, ',', '.') : '-' }}
                                        <br>
                                        <a href="#" class="btn btn-xs btn-pill btn-outline-primary" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $data->id ?? '' }}"
                                            data-field="target"
                                            data-value="{{ $data->target ?? '' }}"
                                            data-indikator="{{ $item->indikator_name }}"
                                            data-tahun="{{ $th }}">Edit
                                        </a>
                                        
                                    </td>
                                    <td>
                                        {{ $data?->target !== null ? number_format($data->realisasi, $decimalPlaces, ',', '.') : '-' }}
                                        <br>
                                        <a href="#" class="btn btn-xs btn-pill btn-outline-primary" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $data->id ?? '' }}"
                                            data-field="realisasi"
                                            data-value="{{ $data->realisasi ?? '' }}"
                                            data-indikator="{{ $item->indikator_name }}"
                                            data-tahun="{{ $th }}">Edit
                                        </a>
                                    </td>
                                    <td>
                                        {{ $data?->target !== null ? number_format($data->nasional, $decimalPlaces, ',', '.') : '-' }}
                                        <br>
                                        <a href="#" class="btn btn-xs btn-pill btn-outline-primary" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $data->id ?? '' }}"
                                            data-field="nasional"
                                            data-value="{{ $data->nasional ?? '' }}"
                                            data-indikator="{{ $item->indikator_name }}"
                                            data-tahun="{{ $th }}">Edit
                                        </a>
                                    </td>
                                    
                                @endforeach
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('edit-form');
            const routeTemplate = "{{ route('indikator.update', ['indikator' => '__ID__']) }}";

            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const field = button.getAttribute('data-field');
                const value = button.getAttribute('data-value');
                const indikator = button.getAttribute('data-indikator');
                const tahun = button.getAttribute('data-tahun');

                // isi input di modal
                editModal.querySelector('#edit-id').value = id;
                editModal.querySelector('#edit-field').value = field;
                editModal.querySelector('#edit-value').value = value;
                editModal.querySelector('#modal-title-field').textContent = field.charAt(0).toUpperCase() + field.slice(1);
                editModal.querySelector('#modal-title-indikator').textContent = indikator;
                editModal.querySelector('#modal-title-tahun').textContent = tahun;

                // set action form
                editForm.action = routeTemplate.replace('__ID__', id);
            });
        });
    </script>


@endsection
