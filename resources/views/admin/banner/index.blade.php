@extends('partials.admin.index')
@section('heading')
Banner Bappeda 
@endsection
@section('page')
Banner Bappeda 
@endsection


@section('content')
    <div class="card mb-5 mb-xl-10">
        <div class="card-header justify-content-between">
            <div class="card-title">
                <h3>
                    Daftar Banner Bappeda 
                </h3>
            </div>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBanner">
                <i class="nav-icon fas fa-folder-plus "></i>Tambah
            </button>
            <div class="modal modal-lg fade text-start" tabindex="-1" id="createBanner" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="{{ route('banner.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title">
                                    Input Banner
                                </h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nama Banner</label>
                                            <input type="text"
                                                class="form-control form-control-solid rounded rounded-4"
                                                placeholder="Masukkan nama menu"
                                                required
                                                name="name"
                                                id="name"
                                                autocomplete="name"
                                            >
                                            @error('name')
                                                <div class="is-invalid">
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Unggah Banner</label>
                                            <input 
                                                type="file" 
                                                name="image" 
                                                class="form-control form-control-solid" 
                                                accept="image/*"
                                                required
                                                autocomplete="image"
                                                id="image"
                                            >
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status_id" class="form-label">Status</label>
                                            <select 
                                                id="status_id" 
                                                name="status_id" 
                                                aria-label="Default select example"
                                                class="form-select form-select-solid rounded rounded-4" 
                                                required
                                                autocomplete="status_id"
                                            >
                                                <option value="" disabled selected>Pilih Status</option>
                                                @foreach($status as $data)
                                                    <option value="{{ $data->id }}" >
                                                        {{ $data->name }}
                                                    </option>
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
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-4 hover-scale" data-bs-dismiss="modal">Batal</button>
                                &nbsp;
                                <button type="submit" class="btn btn-primary rounded-4 hover-scale">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table id="tableMenu" class="table table-sm table-striped table-row-bordered border rounded">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="w-50px text-center border border-1">No.</th>
                            <th class="w-50px border border-1"></th>
                            <th class="border border-1">Image</th>
                            <th class="border border-1 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($banner as $item)
                            <tr>
                                <td class="text-center border border-1">{{ $loop->iteration }}</td>
                                <td class="border border-1 text-center">
                                    <button type="button" class="btn btn-icon btn-primary w-35px h-35px mb-sm-0 mb-3" data-bs-toggle="modal" data-bs-target="#createBanner{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <div class="modal modal-lg fade text-start" tabindex="-1" id="createBanner{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form action="{{ route('banner.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">
                                                            Edit Jawaban
                                                        </h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-4">
                                                                <div class="form-group">
                                                                    <label for="name" class="form-label">Nama Banner</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid rounded rounded-4"
                                                                        placeholder="Masukkan nama menu"
                                                                        required
                                                                        name="name"
                                                                        id="name"
                                                                        autocomplete="name"
                                                                        value="{{$item->name}}"
                                                                    >
                                                                    @error('name')
                                                                        <div class="is-invalid">
                                                                            <span class="text-danger">
                                                                                {{$message}}
                                                                            </span>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="image" class="form-label">Unggah Banner</label>
                                                                    <input 
                                                                        type="file" 
                                                                        name="image" 
                                                                        class="form-control form-control-solid" 
                                                                        accept="image/*"
                                                                        required
                                                                        autocomplete="image"
                                                                        id="image"
                                                                    >
                                                                    @error('image')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="status_id2" class="form-label">Status</label>
                                                                    <select 
                                                                        id="status_id2" 
                                                                        name="status_id2" 
                                                                        aria-label="Default select example"
                                                                        class="form-select form-select-solid rounded rounded-4" 
                                                                        required
                                                                        autocomplete="status_id2"
                                                                    >
                                                                        <option value="" disabled selected>Pilih Status</option>
                                                                        @foreach($status as $data)
                                                                            <option value="{{ $data->id }}" {{ $data->id == $item->status_id ? 'selected' : '' }}>
                                                                                {{ $data->name }}
                                                                            </option>
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-4 hover-scale" data-bs-dismiss="modal">Batal</button>
                                                        &nbsp;
                                                        <button type="submit" class="btn btn-primary rounded-4 hover-scale">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td class="border border-1">{{ $item->image }}</td> --}}
                                <td class="border border-1">
                                    <img src="{{ asset('uploads/banner/' . $item->image) }}" alt="File Image" class="w-200px h-200px">
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
        
        $("#status_id").select2();
        $("#status_id2").select2();
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
