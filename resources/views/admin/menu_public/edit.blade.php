@extends('partials.admin.index')
@section('heading')
    Menu Publik
@endsection
@section('page')
    Data Menu Publik
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('menu-public.update', $findMenu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h3 class="card-title">Edit Data Menu Publik</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Menu</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan nama menu"
                                required
                                name="name"
                                id="name"
                                autocomplete="name"
                                value="{{$findMenu->name}}"
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

                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="parent_id" class="form-label">Parent Menu</label>
                            @php
                            function renderMenuOptions($menus, $prefix = '', $selectedMenuId = null) {
                                foreach ($menus as $menu) {
                                    $selected = $menu->id == $selectedMenuId ? 'selected' : '';
                                    echo '<option value="' . $menu->id . '" ' . $selected . '>' . $prefix . $menu->name . '</option>';
                                    if ($menu->_children->isNotEmpty()) {
                                        renderMenuOptions($menu->_children, $prefix . '-- ', $selectedMenuId);
                                    }
                                }
                            }
                            @endphp

                           

                            <select 
                                id="parent_id" 
                                name="parent_id" 
                                aria-label="Default select example"
                                class="form-select form-select-solid rounded rounded-4" 
                                autocomplete="parent_id"
                            >
                                {{-- <option value="">None</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $menu->id == $findMenu->parent_id ? 'selected' : '' }}>
                                        {{ $menu->name }}
                                    </option>
                                @endforeach --}}
                                <option value="" >Select Menu</option>
                                @php
                                    // Ambil ID menu yang sedang di-edit
                                    $selectedMenuId = $findMenu->parent_id ?? null; // `parent_id` adalah kolom yang mengacu pada parent dari menu yang sedang di-edit
                                    renderMenuOptions($menus, '', $selectedMenuId);
                                @endphp
                            </select>
                            @error('parent_id')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
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
                                    <option value="{{ $data->id }}" {{ $data->id == $findMenu->status_id ? 'selected' : '' }}>
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

                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="url" class="form-label">Alamat URL</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan alamat url"
                                name="url"
                                id="url"
                                autocomplete="url"
                                value="{{$findMenu->url}}"
                            >
                            @error('url')
                                <div class="is-invalid">
                                    <span class="text-danger">
                                        {{$message}}
                                    </span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="order_no" class="form-label">No Order</label>
                            <input type="text" 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                                placeholder="Masukkan angka"
                                class="form-control form-control-solid rounded rounded-4"
                                name="order_no"
                                id="order_no"
                                autocomplete="order_no"
                                value="{{$findMenu->order_no}}"

                            >
                            @error('order_no')
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
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                &nbsp;
                <a href="{{route('menu-public.index')}}" class="btn btn-sm btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
    
@endsection

@section('script')
    <script>
        $("#status_id").select2();
        $("#parent_id").select2();


    </script>
@endsection
