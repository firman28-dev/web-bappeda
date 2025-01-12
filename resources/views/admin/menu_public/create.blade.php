@extends('partials.admin.index')
@section('heading')
    Menu Publik
@endsection
@section('page')
    Data Menu Publik
@endsection

@section('content')
    <div class="card shadow-sm rounded-4">
        <form action="{{ route('menu-public.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Input Data Menu Publik</h3>
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
                                function renderMenuOptions($menus, $prefix = '') {
                                    foreach ($menus as $menu) {
                                        echo '<option value="' . $menu->id . '">' . $prefix . $menu->name . '</option>';
                                        if ($menu->_children->isNotEmpty()) {
                                            renderMenuOptions($menu->_children, $prefix . '-- ');
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
                                    <option value="{{ $menu->id }}" >
                                        {{ $menu->name }}
                                    </option>
                                    @if ($menu->_children->isNotEmpty())
                                        @foreach ($menu->_children as $child)
                                            <option value="{{ $child->id }}">-- {{ $child->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach --}}
                                <option value="" disabled selected>Select Menu</option>
                                @php renderMenuOptions($menus); @endphp
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

                    <div class="col-lg-6 mb-4">
                        <div class="form-group">
                            <label for="url" class="form-label">Alamat URL</label>
                            <input type="text"
                                class="form-control form-control-solid rounded rounded-4"
                                placeholder="Masukkan alamat url"
                                name="url"
                                id="url"
                                autocomplete="url"
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
