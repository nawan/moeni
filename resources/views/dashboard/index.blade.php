@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap5.min.css') }}" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
{{-- fontawesome css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/fontawesome/css/fontawesome.min.css') }}">
{{-- <link rel="stylesheet" href="{{ URL::asset('assets/toastr/css/toastr.min.css') }}" /> --}}
<style>
    .card-hover:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }
    .card-icon {
        color: gray;
    }
    .icon-flipped {
        transform: scaleX(-1);
        -moz-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        -ms-transform: scaleX(-1);
}
</style>
@endpush

@push('script')
{{-- sweet alert2 js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert2.all.min.js') }}"></script>
{{-- sweet alert js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert.min.js') }}"></script>
{{-- jquery jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-3.6.4.slim.js') }}"></script>
{{-- fontawesome script --}}
<script type="text/javascript" src="{{ URL::asset('assets/fontawesome/js/fontawesome.min.js') }}"></script>
{{-- bootstrap@5.3.0-alpha3 jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap4.bundle.min.js') }}"></script>
{{-- highchart js --}}
<script type="text/javascript" src="{{ URL::asset('assets/highcharts/npm/charts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highcharts/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highcharts/exporting.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highcharts/export-data.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/highcharts/accessibility.js') }}"></script>

@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="mb-2 text-decoration-none"><i class="fas fa-home"></i>  Dashboard</a></li>
    </ol>
</nav>

<div class="row mb-2">
    <div class="col-xl-4 col-md-6">
        <div class="card card-hover bg-primary mb-4">
            <div class="card-body">
                <div class="row align-middle">
                    <div class="col font-bold display-1 text-center text-white">
                        <i class="fa fa-warehouse"></i>
                    </div>
                    <div class="col text-white">
                        <div class="row text-uppercase">
                            Item Bahan Tersedia
                        </div>
                        <div class="row text-uppercase display-6 fw-bold">
                            {{ $itemBahan }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light d-flex align-items-center justify-content-between">
                <a class="small stretched-link" href="{{ route('bahan.index') }}" target="_blank"><span class="badge bg-primary text-lg text-white">Lihat Item Bahan Tersedia</span></a>
                <div class="small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card card-hover bg-danger mb-4">

            <div class="card-body">
                <div class="row align-middle">
                    <div class="col font-bold display-1 text-center text-white">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="col text-white">
                        <div class="row text-uppercase">
                            data pelanggan
                        </div>
                        <div class="row text-uppercase display-6 fw-bold">
                            {{ $jumlahClient }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light d-flex align-items-center justify-content-between">
                <a class="small stretched-link" href="{{ route('client.index') }}" target="_blank"><span class="badge bg-danger text-lg text-white">Lihat Data Pelanggan</span></a>
                <div class="small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card card-hover bg-success mb-4">
            <div class="card-body">
                <div class="row align-middle">
                    <div class="col font-bold display-1 text-center text-white">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                    <div class="col text-white">
                        <div class="row text-uppercase">
                            Jumlah PO
                        </div>
                        <div class="row text-uppercase display-6 fw-bold">
                            {{ $jumlahPO }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light d-flex align-items-center justify-content-between">
                <a class="small stretched-link" href="{{ route('production.index') }}" target="_blank"><span class="badge bg-success text-lg text-white">Lihat Data PO</span></a>
                <div class="small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-xl-6 col-md-6">
        <div class="card card-hover bg-warning mb-4">
            <div class="card-body">
                <div class="row align-middle">
                    <div class="col font-bold display-1 text-center text-white">
                        <i class="fa fa-money-check-alt"></i>
                    </div>
                    <div class="col text-white">
                        <div class="row text-uppercase">
                            total pendapatan
                        </div>
                        <div class="row text-capitalize display-6 fw-bold">
                            Rp {{ number_format($totalPendapatan, 0, ',','.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light d-flex align-items-center justify-content-between">
                <a class="small stretched-link" href="{{ route('payment.history') }}" target="_blank"><span class="badge bg-warning text-lg text-white">Lihat Detail Pembayaran</span></a>
                <div class="small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6">
        <div class="card card-hover bg-secondary mb-4">
            <div class="card-body">
                <div class="row align-middle">
                    <div class="col font-bold display-1 text-center text-white">
                        <i class="fa fa-file-invoice"></i>
                    </div>
                    <div class="col text-white">
                        <div class="row text-uppercase">
                            Total PO Belum Terbayar
                        </div>
                        <div class="row text-capitalize display-6 fw-bold">
                            Rp {{ number_format($potensiPendapatan, 0, ',','.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light d-flex align-items-center justify-content-between">
                <a class="small stretched-link" href="{{ route('payment.index') }}" target="_blank"><span class="badge bg-secondary text-lg text-white">Lihat Data Belum Terbayar</span></a>
                <div class="small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection