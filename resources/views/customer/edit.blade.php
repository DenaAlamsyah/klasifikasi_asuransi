@extends('layouts.app')

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Ubah Data Pelanggan</h1>
        <a href="{{ route('customer.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
            <h6 class="m-0 font-weight-bold text-primary">Form ubah data Pelanggan</h6>
        </div>
        <div class="p-3">
            <form action="{{ route('customer.update', ['customer' => $customer]) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name">Nama</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="nama" name="name"
                        value="{{ old('name', $customer->name) }}">
                </div>
                <div class="mb-3">
                    <label for="address">Alamat</label>
                    <textarea class="form-control form-control-solid" id="address" type="text" placeholder="Alamat"
                        name="address">{{ old('address', $customer->address) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="phone">No Telepon</label>
                    <input class="form-control form-control-solid" id="phone" type="text" placeholder="No. Handphone"
                        name="phone" value="{{ old('phone', $customer->phone) }}">
                </div>
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input class="form-control form-control-solid" id="email" type="text" placeholder="E-mail"
                        name="email" value="{{ old('email', $customer->email) }}">
                </div>
                <div class="mb-3">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="form-control form-control-solid" id="gender" placeholder="gender" name="gender">
                        <option value="male" {{ old('gender', $customer->gender)==='male' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="female" {{ old('gender', $customer->gender)==='female' ? 'selected' : ''
                            }}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="indentity_number">No. KTP</label>
                    <input class="form-control form-control-solid" id="indentity_number" type="number"
                        placeholder="No. KTP" name="indentity_number"
                        value="{{ old('indentity_number', $customer->indentity_number) }}">
                </div>
                <div class="mb-3">
                    <label for="birth_place">Tempat Lahir</label>
                    <input class="form-control form-control-solid" id="name" type="text" placeholder="Tempat Lahir"
                        name="birth_place" value="{{ old('birth_place', $customer->birth_place) }}">
                </div>
                <div class="mb-3">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input class="form-control form-control-solid" id="name" type="Date" placeholder="Tanggal Lahir"
                        name="birth_date" value="{{ old('birth_date', $customer->birth_date) }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
    @endsection
