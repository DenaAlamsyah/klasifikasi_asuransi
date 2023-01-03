@extends('layouts.app')

@push('css')
<!-- Custom styles for this page -->
<link href="{{ asset('bootstrap/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
{{-- Begin Page Content --}}
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
        <a href="{{ route('customers.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>NIK</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
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
            ajax: "{{ route('customers.index') }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'phone', name: 'phone'},
                {data: 'email', name: 'email'},
                {data: 'gender', name: 'gender'},
                {data: 'indentity_number', name: 'indentity_number'},
                {data: 'birth_place', name: 'birth_place'},
                {data: 'birth_date', name: 'birth_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    function doDelete(el) {
        const id = $(el).data('id');
        const route = `{{ route('customers.destroy', ['customers' => ':id']) }}`
        console.log(route);
        Swal.fire({
            title: 'Hapus Data Pelanggan',
            text: 'Apakah anda yakin ingin menghapus item ini ?',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                const url = route.replace(':id', id);
                const form = $('#form-delete');
                form.attr('action', url);
                form.submit();
            }
        })
    }
</script>
@endpush
