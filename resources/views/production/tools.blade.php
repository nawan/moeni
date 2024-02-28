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
 .v-counter {
    border-radius: 32px;
    max-width: 100px;
    overflow: auto;
    padding: 0px 4px;
    border: 1px solid #323140;
    margin: 5px;
}

.v-counter input[type=button]:hover {
    color: black;
    font-weight: bold;
    background-color: transparent;
}
.v-counter span {
   
    font-size: 13px;
    color: black;
    font-family: 'Open Sans';
}
.v-counter input[type=button], input[type=number] {
    display: inline-block;
    width: 50px;
    background-color: transparent;
    outline: none;
    border: none;
    text-align: center;
    cursor: pointer;
    padding: 0px;
    color: black;
    height: 33px;
    font-family: 'Open Sans';
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
<script type="text/javascript" src="{{ URL::asset('js/plusminus-counter.js') }}"></script>
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

        var table = $('#data-bahan').DataTable({
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
                    data: 'name',
                    name: 'name',
                    render: function(data, type, full, meta) {
                        return "<span class=\"text-capitalize\">"+ data +"</span>";
                    }
                },
                {
                    data: 'foto_bahan',
                    name: 'foto_bahan',
                    render: function(data, type, full, meta) {
                        return "<img src=\"../storage/" + data + "\" width=\"120\" height=\"60\"/>";
                    },
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'jml_stok',
                    name: 'jml_stok',
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
        <li class="breadcrumb-item" aria-current="page">Produksi</li>
        <li class="breadcrumb-item active" aria-current="page">Input Bahan</li>
    </ol>
</nav>

<section class="content">
    <div class="row mt-10 mb-5">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
                    Pesanan Client {{ $production->user->name }} produksi {{ $production->jenis_box }}
                </div>
                <div class="card-body overflow-auto" style="height: 700px">
                    <table class="table table-bordered table-hover text-center align-middle stripe" id="data-bahan" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Bahan</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" colspan="6">
                                    Data Kosong
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
                    <i class="fa fa-cart-plus"></i> cart
                </div>
                <div class="card-body overflow-auto" style="height: 700px">
                    <table class="table align-middle" id="data_event_alat" style="width:100%;">
                        <thead class="thead thead-light bg-secondary text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productionBahans as $productionBahan)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                <td class="align-middle text-capitalize">
                                    {{ $productionBahan->tool_name }}
                                </td>
                                <td class="align-middle text-left">
                                    {{ $productionBahan->quantity }}
                                </td>
                                <td class="align-middle">
                                    <form class="d-inline m-1" action= "{{ route('production-tool.destroy', ['production_id' => $production->id, 'production_tool_id' => $productionBahan->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-outline-danger btn-sm" title="Hapus Bahan" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Kosong
                                </td>
                            </tr>
                            @endforelse
                            <tr class="fw-bold text-end">
                                <td colspan="2">Total Harga </td>
                                <td colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">
                                    @php $encryptID = Crypt::encrypt($production->id); @endphp
                                    @if($total == 0)
                                        <form class="d-inline m-1" action= "{{ route('submit.bahan', $encryptID) }}"  method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-secondary" title="Submit" data-toggle="tooltip" data-placement="top" type="submit" disabled><i class="fa fa-check"></i> Checkout</button>
                                        </form>
                                    @else
                                        <form class="d-inline m-1" action= "{{ route('submit.bahan', $encryptID) }}" method="POST">
                                            @csrf
                                            {{-- <input type="hidden" name="total_price" value={{ $total }}> --}}
                                            <button class="btn btn-sm btn-outline-primary" title="Submit" data-toggle="tooltip" data-placement="top" type="submit"><i class="fa fa-check"></i> Checkout</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection