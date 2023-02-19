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
                    <label for="name">Nama : </label>
                    <label for="name">{{$customer->name}}</label>
                </div>
                <div class="mb-3">
                    <label for="address">Alamat : </label>
                    <label for="address">{{$customer->address}}</label>
                    {{-- <textarea class="form-control form-control-solid" id="address" type="text" placeholder="Alamat"
                        name="address">{{ old('address', $customer->address) }}</textarea> --}}
                </div>
                <div class="mb-3">
                    <label for="phone">No Telepon : </label>
                    <label for="address">{{$customer->phone}}</label>
                </div>
                <div class="mb-3">
                    <label for="email">E-mail : </label>
                    <label for="address">{{$customer->email}}</label>
                </div>
                <div class="mb-3">
                    <label for="gender">Jenis Kelamin : </label>
                    <label for="address">{{$customer->gender}}</label>
                </div>
                <div class="mb-3">
                    <label for="indentity_number">No. KTP : </label>
                    <label for="address">{{$customer->indentity_number}}</label>
                </div>
                <div class="mb-3">
                    <label for="birth_place">Tempat Lahir : </label>
                    <label for="address">{{$customer->birth_place}}</label>
                </div>
                <div class="mb-3">
                    <label for="birth_date">Tanggal Lahir : </label>
                    <label for="address">{{$customer->birth_date}}</label>
                </div>
                <div class="card-body">
                    <a href="{{ route('building.create', ['customerId' => $customer->id]) }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i
class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Bangunan</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Bangunan</th>
                                    <th>Alamat</th>
                                    <th>Prediction</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form action="#" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>

@endsection

@push('js')
<!-- Page level plugins -->
<script src="{{ asset('bootstrap/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bootstrap/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('building.by-customer-id', ['customerId' => "$customer->id"])}}",
            columns: [
                {data: 'building_object.name', name: 'building_object.name'},
                {data: 'address', name: 'address'},
                {data: 'prediction', name: 'prediction'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function doDelete(el) {
        const id = $(el).data('id');
        const route = `{{ route('building.destroy', ['building' => ':id']) }}`
        Swal.fire({
            title: 'Hapus Data Bangunan',
            text: 'Apakah anda yakin ingin menghapus item ini ?',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const url = route.replace(':id', id);
                const form = $('#form-delete');
                console.log('ID ' + id,url)
                form.attr('action', url);
                form.submit();
            }
        })
    }
</script>
@endpush