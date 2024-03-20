@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
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

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Billing</li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('payment.history') }}">Riwayat</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pembayaran</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
        Detail Data Pembayaran
    </div>
    <div class="card-group bg-light mt-10">
        <div class="card-body">
            <div class="card-group">
                <div class="card-body text-center align-middle col-md-6">
                    <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                        {{ $production->user->name }}
                    </div>
                    <div class="card-body bg-light">
                        <div class="card-group">
                            <div class="card-body col-md-6">
                                <div class="card-img mt-2">
                                    @if($production->user->image)  
                                    <img src="{{ asset('storage/' . $production->user->image) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                                    @else
                                    <img src="{{ $production->user->gravatar }}" width="300" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="card-body col-md-6">
                                <p class="card-text fw-bold m-0">Nomor Kontak</p>
                                <p class="fst-italic mb-2">{{ $production->user->no_kontak}}</p>
                                <p class="card-text fw-bold m-0">Alamat</p>
                                <p class="fst-italic text-capitalize mb-2">{{ $production->user->alamat }}</p>
                                <p class="card-text fw-bold m-0">Pre Order</p>
                                <p class="fst-italic text-capitalize mb-2">
                                    {{ $production->pre_order }}
                                </p>
                                <p class="card-text fw-bold m-0">Jenis Box</p>
                                <p class="fst-italic text-capitalize mb-2">
                                    {{ $production->jenis_box }}
                                </p>
                                <p class="card-text fw-bold m-0">Total Harga</p>
                                <p class="fst-italic text-capitalize mb-2">
                                    Rp {{ number_format($production->total_price, 0, ',','.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center align-middle col-md-6">
                    <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                        Pre Order {{ $production->jenis_box }}
                    </div>
                    <div class="card-body bg-light">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th scope="col">Daftar Bahan</th>
                                    <th scope="col">Daftar Tukang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="justify-content-center">
                                        <table class="table table-borderless justify-content-center">
                                                @forelse($productionTools as $bahan)
                                                <tr class="fst-italic text-muted text-capitalize">
                                                    <td class="text-end">
                                                        {{ $bahan->quantity }}
                                                    </td>
                                                    <td class="text-start">
                                                        {{ $bahan->tool->name }}, 
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr class="fst-italic text-muted text-capitalize">
                                                    <td colspan="2" class="text-end">
                                                        Tidak Ada Bahan Terpakai
                                                    </td>
                                                </tr>
                                                @endforelse
                                        </table>
                                    </td>
                                    <td>
                                        @forelse($productionUsers as $tukang)
                                        <span class="fst-italic text-muted text-capitalize">
                                            {{ $tukang->user_name }}, 
                                        </span>
                                        @empty
                                        <span class="fst-italic text-muted text-uppercase">
                                            Tidak Ada Tukang
                                        </span>
                                        @endforelse
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-footer text-start">
                            <p class="card-text fw-bold m-0">Catatan :</p>
                            <p class="fst-italic text-capitalize mb-2">{!! html_entity_decode($production->note, ENT_QUOTES, 'UTF-8' ) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body col-md-12">
                <div class="card-header text-white text-uppercase text-center fw-bold bg-secondary">
                    Bukti Bayar 
                </div>
                <div class="card-body bg-light">
                    <div class="card-group">
                        <div class="card-body col-md-6">
                            <div class="card-img mt-2">
                                <img src="{{ asset('storage/' . $payment->payment_proof) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="250" alt="">
                            </div>
                        </div>
                        <div class="card-body col-md-6">
                            <p class="card-text fw-bold mb-2">Status Pembayaran : 
                                @if ($payment->status_payment == 'DOWN PAYMENT')
                                    <span class="badge badge-md bg-success fw-bold text-uppercase">down payment</span>
                                @elseif ($payment->status_payment == 'DOWN PAYMENT/PAID')
                                    <span class="badge badge-md bg-success fw-bold text-uppercase">down payment</span>
                                @elseif ($payment->status_payment == 'PELUNASAN/PAID')
                                    <span class="badge badge-md bg-success fw-bold text-uppercase">pelunasan</span>
                                @else
                                    <span class="badge badge-md bg-success fw-bold text-uppercase">full payment</span>
                                @endif
                            </p>
                            <p class="card-text fw-bold mb-2">Kode Pembayaran : 
                                <span class="fst-italic fw-normal text-uppercase">
                                    {{ $payment->payment_code }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Nominal Pembayaran : 
                                <span class="fst-italic fw-normal text-capitalize">
                                    Rp {{ number_format($payment->payment_amount, 0, ',', '.') }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Tanggal Bayar : 
                                <span class="fst-italic fw-normal text-capitalize">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Metode Pembayaran : 
                                <span class="fst-italic fw-normal text-uppercase">
                                    {{ $payment->payment_method }}
                                </span>
                            </p>
                            <p class="card-text fw-bold mb-2">Diterima Oleh : 
                                <span class="fst-italic text-capitalize text-primary">
                                    @php $encryptID = Crypt::encrypt($received_by->id); @endphp
                                    <a href="{{ route('admin.show',$encryptID) }}">
                                        {{ $received_by->name }} <i class="fa fa-check-circle fst-italic"></i>
                                    </a>
                                </span>
                            </p>
                            <p>
                                @php $encryptPrintID = Crypt::encrypt($payment->id); @endphp
                                <a href="{{ route("cetak.print", $encryptPrintID ) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-3">
        <a href="{{ route('payment.history') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>

@endsection