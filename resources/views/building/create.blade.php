@extends('layouts.app')

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Bangunan</h1>
        <a href="{{ route('building.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
            <h6 class="m-0 font-weight-bold text-primary">Form tambah data bangunan</h6>
        </div>
        <div class="p-3 col col-6">
            <form action="{{ route('building.store') }}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{ request()->customerId }}">
                <div class="mb-3">
                    <label for="building_object_id">Objek Bangunan</label>
                    <select class="form-control form-control-solid" id="building_object_id" type="text" placeholder="Nama" name="building_object_id">
                        @foreach ($buildings_object as $building_object)
                        <option value="{{ $building_object->id }}">{{ $building_object->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="building_type_id">Tipe Bangunan</label>
                    <select class="form-control form-control-solid" id="building_type_id" type="text" placeholder="type" name="building_type_id">
                        @foreach ($buildings_type as $building_type)
                        <option value="{{ $building_type->id }}">{{ $building_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="building_flood_area_id">Area Banjir</label>
                    <select class="form-control form-control-solid" id="building_flood_area_id" type="text" placeholder="flood" name="building_flood_area_id">
                        @foreach ($buildings_flood_area as $building_flood_area)
                        <option value="{{ $building_flood_area->id }}">{{ $building_flood_area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat Bangunan</label>
                    <input class="form-control form-control-solid" id="address" type="address" placeholder="address"
                        name="address" value="{{ old('address') }}">
                </div>
                <div class="mb-3">
                    <label for="address">Resiko Sekitar</label>
                    <div class="mb-2">
                        <label for="front">Depan</label>
                        <input class="form-control form-control-solid" id="front" type="depan" placeholder="depan"
                        name="front" value="{{ old('depan') }}">
                        <label for="behind">Belakang</label>
                        <input class="form-control form-control-solid" id="behind" type="belakang" placeholder="belakang"
                        name="behind" value="{{ old('belakang') }}">
                        <label for="right">Kanan</label>
                        <input class="form-control form-control-solid" id="right" type="kanan" placeholder="kanan"
                        name="right" value="{{ old('kanan') }}">
                        <label for="left">Kiri</label>
                        <input class="form-control form-control-solid" id="left" type="kiri" placeholder="kiri"
                        name="left" value="{{ old('kiri') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="floors">Jumlah Lantai</label>
                    <input class="form-control form-control-solid" id="floors" type="text"
                        placeholder="0" attribute="number" name="floors" value="{{ old('floors') }}">
                </div>
                <div class="mb-3">
                    <label for="roof_type">Tipe Atap</label>
                    <input class="form-control form-control-solid" id="roof_type" type="text"
                        placeholder="Tipe atap" name="roof_type" value="{{ old('roof_type') }}">
                </div>
                <div class="mb-3">
                    <label for="wall_type">Tipe Dinding</label>
                    <input class="form-control form-control-solid" id="wall_type" type="text" placeholder="Tipe dinding"
                        name="wall_type" value="{{ old('wall_type') }}">
                </div>
                <div class="mb-3">
                    <label for="floor_type">Tipe Lantai</label>
                    <input class="form-control form-control-solid" id="floor_type" type="text" placeholder="Tipe Lantai"
                        name="floor_type" value="{{ old('floor_type') }}">
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
                    <label for="is_cctv_installed">cctv</label>
                    <select class="form-control form-control-solid" id="produksi" placeholder="kebakaran" name="is_cctv_installed">
                        <option value="yes" {{ old('is_cctv_installed')==='yes' ? 'selected' : '' }}>Iya</option>
                        <option value="no" {{ old('is_cctv_installed')==='no' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="earthquake_area">Area Gempa</label>
                    <select class="form-control form-control-solid" id="name" type="text" placeholder="gempa" name="earthquake_area">
                        <option value="area 1" {{ old('earthquake_area')==='area 1' ? 'selected' : '' }}>Area 1</option>
                        <option value="area 2" {{ old('earthquake_area')==='area 2' ? 'selected' : '' }}>Area 2</option>
                        <option value="area 3" {{ old('earthquake_area')==='area 3' ? 'selected' : '' }}>Area 3</option>
                        <option value="area 4" {{ old('earthquake_area')==='area 4' ? 'selected' : '' }}>Area 4</option>
                        <option value="area 5" {{ old('earthquake_area')==='area 5' ? 'selected' : '' }}>Area 5</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="building_value">Nominal Bangunan</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="nominal"
                        name="building_value" value="{{ old('building_value') }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
{{-- // In your Javascript (external .js resource or <script> tag) --}}
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    </script>
@endpush