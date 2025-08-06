@extends('partials.admin.master')

@section('title', 'Gallery')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dataTables.bootstrap5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">


@endsection

@section('style')
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Gallery</h3>
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
                    <li class="breadcrumb-item active">Gallery</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Daftar Gallery</h5>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mx-auto mt-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModallogin"><i class="fa-solid fa-plus pe-1"></i>Tambah</button>
            <div class="table-responsive custom-scrollbar">
                <table class="display border table-striped" id="basic-1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 90px" class="text-center"> <span class="c-o-light f-w-600">No</span></th>
                            <th class="text-start w-25"> <span class="c-o-light f-w-600">Keterangan Gallery</span></th>
                            <th class="text-start"> <span class="c-o-light f-w-600">Gambar</span></th>
                            <th class="w-25"> <span class="c-o-light f-w-600 ">Status</span></th>
                            <th> <span class="c-o-light f-w-600">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallery as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-start">{{ $item->name }}</td>

                                <td class="text-start">
                                    @if ($item->image)
                                        <figure itemprop="associatedMedia" itemscope="">
                                            <a href="{{ asset('uploads/gallery/' . $item->image) }}" itemprop="contentUrl" data-size="1600x950">
                                                <img class="img-thumbnail w-50" src="{{ asset('uploads/gallery/' . $item->image) }}" itemprop="thumbnail" alt="Image description">
                                            </a>
                                        </figure>
                                    @else
                                        <p>-</p>
                                    @endif
                                </td>
                                <td> 
                                    <span class="badge {{ $item->_status->id == 4 ? 'badge-light-success' : 'badge-light-danger' }}"> {{ $item->_status->name }}</span>
                                </td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> 
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalEditGallery{{ $item->id }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        </li>

                                        {{-- Modal Edit Gallery --}}
                                        <div class="modal fade" id="modalEditGallery{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditGalleryLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content dark-sign-up">
                                                    <div class="modal-body social-profile text-start">
                                                        <div class="modal-toggle-wrapper">
                                                            <h3>Edit Gallery</h3>
                                                            <p class="f-light">Silahkan perbarui gallery dan keterangan.</p>

                                                            <form class="row g-3 needs-validation theme-form"
                                                                action="{{ route('gallery.update', $item->id) }}"
                                                                method="POST"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="keterangan{{ $item->id }}">Keterangan Foto</label>
                                                                    <input class="form-control" id="keterangan{{ $item->id }}" name="name" type="text"
                                                                        value="{{ $item->name }}" required>
                                                                    @error('name')
                                                                        <div class="is-invalid">
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="image{{ $item->id }}">Foto Gallery</label>
                                                                    <input class="form-control image-input" type="file" name="image" id="image{{ $item->id }}"
                                                                        accept="image/*">
                                                                    @error('image')
                                                                        <div class="is-invalid">
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label class="form-label" for="status{{ $item->id }}">Pilih Status</label>
                                                                    <select class="form-select js-example-basic-single col-sm-12" name="status_id" id="status{{ $item->id }}" required>
                                                                        <option value="" disabled>-- Pilih Status --</option>
                                                                        @foreach ($status as $st)
                                                                            <option value="{{ $st->id }}"
                                                                                {{ $item->status_id == $st->id ? 'selected' : '' }}>
                                                                                {{ $st->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('status_id')
                                                                        <div class="is-invalid">
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-12">
                                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <li class="delete">
                                            <a href="" data-bs-target="#confirmDelete{{ $item->id }}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can" ></i>
                                            </a>
                                            <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="confirmDelete{{ $item->id }}">
                                                <form action="{{ route('gallery.destroy', $item->id) }}" method="POST">
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
        
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="exampleModallogin" tabindex="-1" role="dialog" aria-labelledby="exampleModallogin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content dark-sign-up">
        <div class="modal-body social-profile text-start">
            <div class="modal-toggle-wrapper">
                <h3>Tambahkan Gallery</h3>
                <p class="f-light">Silahkan tambahkan gallery dan keterangan.</p>
                <form class="row g-3 needs-validation theme-form" action="{{ route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-12">
                        <label class="form-label" for="inputEmailEnter">Keterangan Foto</label>
                        <input class="form-control" id="name" name="name" type="text" placeholder="Keterangan Foto" required>
                        @error('name')
                            <div class="is-invalid">
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="inputPasswordEnter">Foto Gallery</label>
                        <input class="form-control image-input" type="file" placeholder="Nama URL" name="image" id="image"autocomplete="image" accept="image/*" required>
                        @error('image')
                            <div class="is-invalid">
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="status">Pilih Status</label>
                        <select class="form-select js-example-basic-single col-sm-12" name="status_id" id="status_id" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            @foreach ($status as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <div class="is-invalid">
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            </div>
                        @enderror
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>




<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                    <ul class="modal-img">
                        <li> <img src="{{asset('assets/images/gif/danger.gif')}}" alt="error"></li>
                    </ul>
                    <h4 class="text-center pb-2">Terjadi Kesalahan Upload</h4>
                    <p class="text-center c-light">Ukuran File yang kamu upload maksimal 3 MB. Silahkan diulangi kembali
                        uploadnya</p>
                    <button class="btn btn-secondary d-flex m-auto" type="button" data-bs-dismiss="modal">Close</button>
                </div>
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
    
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
<script src="{{ asset('assets/js/custom-add-product4.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script>
    document.querySelectorAll('.image-input').forEach(function(input) {
        input.addEventListener('change', function () {
            const file = this.files[0];
            const maxSize = 3 * 1024 * 1024; // 3 MB

            if (file && file.size > maxSize) {
                this.value = ''; // reset input

                const modalElement = document.getElementById('exampleModalCenter1');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        });
    });
</script>




<script>
    // Inisialisasi Select2 setiap kali modal (tambah/edit) dibuka
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('.js-example-basic-single').select2({
            dropdownParent: $(this)
        });
    });

    // Optional: destroy agar tidak duplikasi (jika error tetap muncul)
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('.js-example-basic-single').select2('destroy');
    });
</script>

@endsection
