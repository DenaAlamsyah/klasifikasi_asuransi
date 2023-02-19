@extends('layouts.app')

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Detail Data Bangunan</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Detail data Bangunan</h6>
        </div>
        <div class="p-3">
            <form action="{{ route('building.show', ['building' => $building]) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name">Nama : </label>
                    <label for="name">{{$building->customer->name}}</label>
                    
                </div>
                <div class="mb-3">
                    <label for="name">Objek Bangunan : </label>
                    <label for="name">{{$building->buildingObject->name}}</label>
                </div>
                <div class="mb-3">
                    <label for="name">Tipe Bangunan : </label>
                    <label for="name">{{$building->buildingType->description}}</label>
                </div>
                <div class="mb-3">
                    <label for="name">Area Banjir : </label>
                    <label for="name">{{$building->buildingFloodArea->name}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat : </label>
                    <label for="address">{{$building->address}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Resiko Sekitar</label>
                    <div class="mb-2">
                        <label for="around">Depan : </label>
                        <label for="front">{{$building->front}}</label><br>
                        <label for="around">Belakang : </label>
                        <label for="behind">{{$building->behind }}</label><br>
                        <label for="around">Kanan : </label>
                        <label for="right">{{$building->right }}</label><br>
                        <label for="around">Kiri : </label>
                        <label for="left">{{$building->left }}</label><br>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Jumlah Lantai : </label>
                    <label for="address">{{$building->floors}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Tipe Atap : </label>
                    <label for="address">{{$building->roof_type}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Tipe Dinding : </label>
                    <label for="address">{{$building->wall_type}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Tipe Lantai : </label>
                    <label for="address">{{$building->floor_type}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Proses Produksi : </label>
                    <label for="address">{{$building->is_production_processv == 'yes' ? 'ya':'tidak'}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Ketersediaan APAR : </label>
                    <label for="address">{{$building->is_wildfire_risk == 'yes' ? 'ya':'tidak'}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Nominal Bangunan : </label>
                    <label for="address">{{$building->building_value}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Keamanan : </label>
                    <label for="address">{{$building->security == 'yes' ?'ya':'tidak'}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Pemasangan cctv : </label>
                    <label for="address">{{$building->is_cctv_installed == 'yes' ? 'ya':'tidak'}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Area Gempa : </label>
                    <label for="address">{{$building->earthquake_area}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Status : </label>
                    <label for="address">{{$building->Status}}</label>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
