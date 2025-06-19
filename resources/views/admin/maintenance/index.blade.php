
@extends('partials.admin.master')

@section('title', 'Maintencen')

@section('css')
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Maintenance</h3>
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
                    <li class="breadcrumb-item active">Maintenance</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid datatable-init">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h5>Jadwal Maintenance</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('maintenance.toggle') }}">
                @csrf
                <div class="form-check form-switch">
                    <input class="form-check-input"
                        id="flexSwitchCheckDefault"
                        type="checkbox"
                        name="mode"
                        value="on"
                        onchange="this.form.submit();"
                        {{ $isMaintenanceOn ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        Mode Maintenance
                    </label>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection
