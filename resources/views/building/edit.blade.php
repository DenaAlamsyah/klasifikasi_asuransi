@extends('layouts.app')

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Ubah Data Bangunan</h1>
        <a href="{{ route('building.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="m-0">
            @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form ubah data Bangunan</h6>
        </div>
        <div class="p-3">
            <form action="{{ route('building.update', ['building' => $building]) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="building_object">Objek Bangunan</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="object" name="building_object"
                        value="{{ old('building_object', $building->building_object) }}">
                </div>
                <div class="mb-3">
                    <label for="building_type">Tipe Bangunan</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="type" name="building_type"
                        value="{{ old('building_type', $building->building_type) }}">
                </div>
                <div class="mb-3">
                    <label for="flood_area">Area Banjir</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="flood" name="flood_area"
                        value="{{ old('flood_area', $building->flood_area) }}">
                </div>
                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="address" name="address"
                        value="{{ old('address', $building->address) }}">
                </div>
                <div class="mb-3">
                    <label for="floors">Jumlah Lantai</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="floors" name="floors"
                        value="{{ old('floors', $building->floors) }}">
                </div>
                <div class="mb-3">
                    <label for="roof_type">Tipe Atap</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="roof" name="roof_type"
                        value="{{ old('roop_type', $building->roop_type) }}">
                </div>
                <div class="mb-3">
                    <label for="wall_type">Tipe Dinding</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="wall" name="wall_type"
                        value="{{ old('wall_type', $building->wall_type) }}">
                </div>
                <div class="mb-3">
                    <label for="floor_type">Tipe Lantai</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="floor" name="floor_type"
                        value="{{ old('floor_type', $building->floor_type) }}">
                </div>
                <div class="mb-3">
                    <label for="production_process">Proses Produksi</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="production" name="production_process"
                        value="{{ old('production_process', $building->production_process) }}">
                </div><div class="mb-3">
                    <label for="wildfire_risk">Resiko Kebakaran</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="wildfire" name="wildfire_risk"
                        value="{{ old('wildfire_risk', $building->wildfire_risk) }}">
                </div><div class="mb-3">
                    <label for="security">Keamanan</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="security" name="security"
                        value="{{ old('security', $building->security) }}">
                </div>
                <div class="mb-3">
                    <label for="cctv_installed">Instalasi CCTV</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="cctv" name="cctv_installed"
                        value="{{ old('cctv_installed', $building->cctv_installed) }}">
                </div><div class="mb-3">
                    <label for="earthquake_area">Area Gempa</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="earthquake" name="earthquake_area"
                        value="{{ old('earthquake_area', $building->earthquake_area) }}">
                </div><div class="mb-3">
                    <label for="building_value">Nilai Bangunan</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="value" name="building_value"
                        value="{{ old('building_value', $building->building_value) }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
