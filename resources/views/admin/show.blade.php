@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
{{-- datatables css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/dataTables.bootstrap5.min.css') }}">
{{-- datatables responsive css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/responsive.dataTables.min.css') }}">
{{-- datatables row order css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/rowReorder.dataTables.min.css') }}">
@endpush

@push('script')
{{-- jquery jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery.min.js') }}"></script>
{{-- bootstrap password jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap-show-password.min.js') }}"></script>
{{-- sweet alert2 js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert2.all.min.js') }}"></script>
{{-- sweet alert js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert.min.js') }}"></script>
{{-- validation form --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
{{-- swal delete validation script --}}
<script type="text/javascript" src="{{ URL::asset('js/swal-delete.js') }}"></script>
{{-- jquery datatables --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/jquery.dataTables.min.js') }}"></script>
{{-- datatables js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.bootstrap5.min.js') }}"></script>
{{-- datatables responsive js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.responsive.min.js') }}"></script>
{{-- datatables row order js --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/dataTables.rowReorder.min.js') }}"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#riwayat-penerimaan').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center',
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pre_order',
                    name: 'pre_order',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'user_id',
                    name: 'user_id',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-uppercase\">"+ data +"</span>";
                    }
                },
                {
                    data: 'jenis_box',
                    name: 'jenis_box',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-uppercase\">"+ data +"</span>";
                    }
                },
                {
                    data: 'payment_method',
                    name: 'payment_method',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-uppercase\">"+ data +"</span>";
                    }
                },
                {
                    data: 'payment_amount',
                    name: 'payment_amount',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">rp "+ data +"</span>";
                    }
                },
                {
                    data: 'payment_date',
                    name: 'payment_date',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"d-inline-flex\">"+ data +"</div>";
                }
                },
            ],
            language: {
                "sProcessing":   "Memproses...",
                "sLoadingRecords": "Memuat...",
                "sLengthMenu":   "Tampilan _MENU_ Baris",
                "sZeroRecords":  "Data Kosong",
                "sInfo":         "Menampilkan _START_-_END_ dari _TOTAL_ Baris",
                "sInfoEmpty":    "Data Kosong",
                "sInfoFiltered": "(dari keseluruhan data)",
                "sInfoPostFix":  "",
                "sSearch":       "Cari Data:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "<<",
                    "sPrevious": "<",
                    "sNext":     ">",
                    "sLast":     ">>"
                },
                "aria": {
                    "sortAscending":  ": Tampilan kolom ascending",
                    "sortDescending": ": Tampilan kolom descending"
                }
            }
        });

    });
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Admin</li>
        <li class="breadcrumb-item active" aria-current="page">Detail Admin</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
        Detail Data Admin
    </div>
    <div class="card-group bg-light mt-10">
        <div class="card-body text-center col-md-6">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Foto Profil
            </div>
            <div class="card-body bg-white p-5" style="width:100%;max-heigth:600px">
                <img src="{{ asset('storage/' . $admin->image) }}" class="rounded img-thumbnail" width="500" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#detail-foto">
            </div>
        </div>

        {{-- modal view show image --}}
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail-foto" tabindex="-1" aria-labelledby="Foto KTP {{ $admin->name }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent" style="border: none">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close-white" data-bs-dismiss="modal"><i class="fa" style="font-size: 2rem;">&#xf00d;</i></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $admin->image) }}" style="width:100%;max-width:500px">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body col-md-6">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Data Admin
            </div>
            <div class="card-body bg-white p-3" style="width:100%;max-heigth:600px">
                <div class="card-text">
                    <p class="card-text fw-bold m-0">Nama Admin</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $admin->name }}</p>
                    <p class="card-text fw-bold m-0">NIK</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $admin->nik }}</p>
                    <p class="card-text fw-bold m-0">No Kontak</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $admin->no_kontak }}</p>
                    <p class="card-text fw-bold m-0">Email</p>
                    <p class="fst-italic mb-2">{{ $admin->email }}</p>
                    <p class="card-text fw-bold m-0">Alamat</p>
                    <p class="fst-italic text-capitalize mb-2">{{ $admin->alamat }}</p>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    @php $encryptID = Crypt::encrypt($admin->id); @endphp
                    @if($admin->is_admin == '1')
                    <a href="{{ route('admin.edit', $encryptID) }}"class="btn btn-secondary m-1 disabled" title="Tulis Catatan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    @else
                    <a href="{{ route('admin.edit', $encryptID) }}"class="btn btn-warning m-1" title="Tulis Catatan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <div class="card-header text-center text-uppercase fw-bold bg-dark text-white">
                Riwayat Approval Pembayaran
            </div>
            <div class="card-body bg-white p-3" style="width:100%; max-heigth:500px">
                <table class="table text-center align-middle" id="riwayat-penerimaan" style="width:100%;">
                    <thead class="thead thead-light bg-secondary text-white table-bordered">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Pre Order</th>
                            <th scope="col">Client</th>
                            <th scope="col">Jenis Box</th>
                            <th scope="col">Jenis Bayar</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center">
                                Data Masih Kosong
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-3">
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>

@endsection