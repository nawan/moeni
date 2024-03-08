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
<style>
    .container{
        width: auto;
        margin: 0 auto;
    }

    ul.tabs{
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    ul.tabs li{
        background: none;
        color: #222;
        display: inline-block;
        padding: 10px 15px;
        cursor: pointer;
        font-weight: bold;
    }

    ul.tabs li.current{
        background: #ededed;
        color: #222;
    }

    .tab-content{
        display: none;
        background: #ededed;
        padding: 15px;
    }

    .tab-content.current{
        display: inherit;
    }
</style>
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
{{-- datatable done --}}
<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var table = $('#status-done').DataTable({
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
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'jenis_box',
                    name: 'jenis_box',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'status_proses',
                    name: 'status_proses',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize badge bg-primary\">"+ data +"</span>";
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">rp "+ data +"</span>";
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
<script>
    $(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Produksi</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('production.proses') }}">Status PO</a></li>
    </ol>
</nav>

<section class="content">
    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
            Data Status Pre Order
        </div>
        <div class="card-body">
            <div class="container">
                <ul class="tabs">
                    <li class="tab-link current" data-tab="tab-1">Designing</li>
                    <li class="tab-link" data-tab="tab-2">Machining</li>
                    <li class="tab-link" data-tab="tab-3">Assembling</li>
                    <li class="tab-link" data-tab="tab-4">Painting</li>
                    <li class="tab-link" data-tab="tab-5">Installation</li>
                    <li class="tab-link" data-tab="tab-6">Tuning</li>
                    <li class="tab-link" data-tab="tab-7">Packing</li>
                    <li class="tab-link" data-tab="tab-8">Delivery</li>
                    <li class="tab-link" data-tab="tab-9">Done</li>
                </ul>
            
                <div id="tab-1" class="tab-content current">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesDesain as $desain)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $desain->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $desain->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $desain->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $desain->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($desain->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($desain->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($desain->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($desain->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($desain->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($desain->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($desain->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($desain->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($desain->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($desain->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($desain->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-2" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesMachining as $mesin)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $mesin->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $mesin->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $mesin->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $mesin->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($mesin->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($mesin->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($mesin->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($mesin->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($mesin->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($mesin->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($mesin->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($mesin->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($mesin->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($mesin->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($mesin->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-3" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesAssembling as $assembling)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $assembling->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $assembling->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $assembling->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $assembling->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($assembling->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($assembling->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($assembling->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($assembling->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($assembling->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($assembling->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($assembling->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($assembling->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($assembling->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($assembling->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($assembling->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-4" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesPainting as $painting)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $painting->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $painting->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $painting->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $painting->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($painting->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($painting->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($painting->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($painting->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($painting->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($painting->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($painting->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($painting->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($painting->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($painting->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($painting->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-5" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesInstalasi as $instalasi)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $instalasi->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $instalasi->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $instalasi->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $instalasi->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($instalasi->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($instalasi->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($instalasi->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($instalasi->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($instalasi->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($instalasi->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($instalasi->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($instalasi->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($instalasi->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($instalasi->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($instalasi->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-6" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesTuning as $tuning)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $tuning->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $tuning->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $tuning->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $tuning->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($tuning->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($tuning->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($tuning->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($tuning->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($tuning->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($tuning->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($tuning->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($tuning->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($tuning->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($tuning->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($tuning->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-7" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesPacking as $packing)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $packing->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $packing->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $packing->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $packing->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($packing->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($packing->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($packing->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($packing->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($packing->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($packing->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($packing->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($packing->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($packing->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($packing->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($packing->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-8" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ubah Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prosesDelivery as $delivery)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="align-middle">
                                    {{ $delivery->pre_order }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $delivery->user->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $delivery->jenis_box }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $delivery->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($delivery->total_price, 0, ',', '.') }}
                                </td>
                                <td class="align-middle">
                                    @php $encryptID = Crypt::encrypt($delivery->id); @endphp
                                    <form class="d-flex justify-content-between gap-1" action= "{{ route('production.ubah-proses', $encryptID) }}" method="POST">
                                        @csrf
                                        <select class="form-select fw-bold" id="status_proses" name="status_proses">
                                            <option {{ ($delivery->status_proses == 'DESIGNING') ? 'selected' : '' }} value="DESIGNING" >Designing</option>
                                            <option {{ ($delivery->status_proses == 'MACHINING') ? 'selected' : '' }} value="MACHINING">Machining</option>
                                            <option {{ ($delivery->status_proses == 'ASSEMBLING') ? 'selected' : '' }} value="ASSEMBLING" >Assembling</option>
                                            <option {{ ($delivery->status_proses == 'PAINTING') ? 'selected' : '' }} value="PAINTING">Painting</option>
                                            <option {{ ($delivery->status_proses == 'INSTALLATION') ? 'selected' : '' }} value="INSTALLATION" >Installation</option>
                                            <option {{ ($delivery->status_proses == 'TUNING') ? 'selected' : '' }} value="TUNING">Tuning</option>
                                            <option {{ ($delivery->status_proses == 'PACKING') ? 'selected' : '' }} value="PACKING" >Packing</option>
                                            <option {{ ($delivery->status_proses == 'DELIVERY') ? 'selected' : '' }} value="DELIVERY">Delivery</option>
                                            <option {{ ($delivery->status_proses == 'DONE') ? 'selected' : '' }} value="DONE">Selesai</option>
                                        </select>
                                        <button class="btn btn-success btn-sm" title="Pindah Proses" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="tab-9" class="tab-content">
                    <table class="table table-bordered table-hover text-center align-middle stripe" id="status-done" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Pre Order</th>
                                <th scope="col">Client</th>
                                <th scope="col">Jenis Box</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center mt-2 mb-2">
                                    Data Kosong
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section

@endsection