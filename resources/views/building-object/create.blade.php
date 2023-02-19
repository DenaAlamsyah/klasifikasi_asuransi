@extends('layouts.app')

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Objek Bangunan</h1>
        <a href="{{ route('building-object.index') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
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
            <h6 class="m-0 font-weight-bold text-primary">Form tambah data objek bangunan</h6>
        </div>
        <div class="p-3">
            <form action="{{ route('building-object.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="toko" name="name">
                </div>
                <div class="mb-3">
                    <label for="descriotion">Deskripsi</label>
                    <textarea class="form-control form-control-solid" id="name" type="text" placeholder="deskripsi"
                        name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
