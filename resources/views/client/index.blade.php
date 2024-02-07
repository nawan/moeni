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
<script>
    window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;
    swal({
        title: 'Apakah Anda Yakin?',
        text: 'Data akan dihapus permanen jika Anda melanjutkan proses',
        icon: 'warning',
        buttons: ["Batal", "Hapus"],
        dangerMode: true,
        timer: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
            swal("Data Berhasil Dihapus", {
                icon: "success",
            });
        }
        else {
            swal("Anda Membatalkan Proses", {
                icon: "error",
            });
        }
    });
}
</script>
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#data-client').DataTable({
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('client.index') }}",
            columnDefs: [{
                    targets: '_all',
                    className: 'dt-center',
            }],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        return "<img src=\"storage/" + data + "\" width=\"120\" height=\"60\"/>";
                    },
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'no_kontak',
                    name: 'no_kontak',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-uppercase\">"+ data +"</span>";
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true,
                    render: function(data){
                    return "<div class=\"d-inline-flex\">"+data+"</div>"
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
        <li class="breadcrumb-item" aria-current="page">Client</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('client.index') }}">Data Client</a></li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
        Data Client
    </div>
    <div class="card-body">
        <div class="d-flex mt-4 mb-3">
            <a href="{{ route('client.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Data Client</a>
        </div>
        <table class="table table-bordered table-hover text-center align-middle stripe" id="data-client" style="width:100%;">
            <thead class="thead thead-light bg-secondary text-white table-bordered">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto KTP</th>
                    <th scope="col">No Kontak</th>
                    <th scope="col">Tanggal Daftar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center">
                        Data Masih Kosong
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection