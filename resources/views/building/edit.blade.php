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
                    <label for="customer_id">Customer</label>
                    <select class="form-control form-control-solid" id="customer_id" type="text" placeholder="Nama" name="customer_id">
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="building_object">Objek Bangunan</label>
                    <select class="form-control form-control-solid" id="building_object_id" type="text" placeholder="Nama" name="building_object_id">
                        @foreach ($buildings_object as $building_object)
                        <option value="{{ $building_object->id }}">{{ $building_object->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="building_type">Tipe Bangunan</label>
                    <select class="form-control form-control-solid" id="building_type_id" type="text" placeholder="type" name="building_type_id">
                        @foreach ($buildings_type as $building_type)
                        <option value="{{ $building_type->id }}">{{ $building_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="flood_area">Area Banjir</label>
                    <select class="form-control form-control-solid" id="building_flood_area_id" type="text" placeholder="flood" name="building_flood_area_id">
                        @foreach ($buildings_flood_area as $building_flood_area)
                        <option value="{{ $building_flood_area->id }}">{{ $building_flood_area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="address" name="address"
                        value="{{ old('address', $building->address) }}">
                </div>
                <div class="mb-3">
                    <label for="address">Resiko Sekitar</label>
                    <div class="mb-2">
                        <label for="around">Depan</label>
                        <input class="form-control form-control-solid" id="front" type="depan" placeholder="depan"
                        name="front" value="{{ old('front', $building->front) }}">
                        <label for="around">Belakang</label>
                        <input class="form-control form-control-solid" id="behind" type="belakang" placeholder="belakang"
                        name="behind" value="{{ old('behind', $building->behind) }}">
                        <label for="around">Kanan</label>
                        <input class="form-control form-control-solid" id="right" type="kanan" placeholder="kanan"
                        name="right" value="{{ old('right', $building->right) }}">
                        <label for="around">Kiri</label>
                        <input class="form-control form-control-solid" id="left" type="kiri" placeholder="kiri"
                        name="left" value="{{ old('left', $building->left) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="floors">Jumlah Lantai</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="floors" name="floors"
                        value="{{ old('floors', $building->floors) }}">
                </div>
                <div class="mb-3">
                    <label for="roof_type">Tipe Atap</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="roof" name="roof_type"
                        value="{{ old('roop_type', $building->roof_type) }}">
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
                    <label for="is_production_process">Proses Produksi</label>
                    <select class="form-control form-control-solid" id="produksi" placeholder="yes" name="is_production_process">
                        <option value="yes" {{ old('is_production_process')==='yes' ? 'selected' : '' }}>Iya</option>
                        <option value="no" {{ old('is_production_process')==='no' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_wildfire_risk">Ketersediaan APAR</label>
                    <select class="form-control form-control-solid" id="produksi" placeholder="kebakaran" name="is_wildfire_risk">
                        <option value="yes" {{ old('is_wildfire_risk')==='yes' ? 'selected' : '' }}>Iya</option>
                        <option value="no" {{ old('is_wildfire_risk')==='no' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="security">Keamanan</label>
                    <select class="form-control form-control-solid" id="security" type="text" placeholder="keamanan" name="security">
                        <option value="yes" {{ old('security')==='yes' ? 'selected' : '' }}>Iya</option>
                        <option value="no" {{ old('security')==='no' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="is_cctv_installed">Instalasi cctv</label>
                    <select class="form-control form-control-solid" id="produksi" placeholder="kebakaran" name="is_cctv_installed">
                        <option value="yes" {{ old('is_cctv_installed')==='yes' ? 'selected' : '' }}>Iya</option>
                        <option value="no" {{ old('is_cctv_installed')==='no' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
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
