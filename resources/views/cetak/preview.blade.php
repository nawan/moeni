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
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Cetak</li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('cetak.index') }}" style="text-decoration: none">Bukti Bayar</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Cetak</a></li>
    </ol>
</nav>

<section class="content mb-10">
    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
            Bukti Pembayaran atas nama {{ $payment->user->name }}
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="print_receipt">
                            <div class="card-body">
                                {{-- company title receipt --}}
                                <div class="invoice-title">
                                    <h4 class="float-end">
                                        @php $encryptID = Crypt::encrypt($payment->id); @endphp
                                        <a href="{{ route("cetak.print", $encryptID) }}" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                                    </h4>
                                    <div class="mb-2">
                                        <img src="{{ URL::asset('/assets/img/logo.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="200px" />
                                    </div>
                                    <div class="text-muted">
                                        <p class="mb-0">Cangkring RT 03 Mulyodadi Bambanglipuro</p>
                                        <p class="mb-1">Bantul Yogyakarta 55764</p>
                                        <p class="mb-1"> <i class="fa fa-phone"></i> 081904146417</p>
                                    </div>
                                </div>
                                <hr class="my-2">
                                {{-- client title receipt --}}
                                <div class="row">
                                    {{-- col 1 --}}
                                    <div class="col-sm-6" style="font-size: 0.8rem">
                                        <div class="text-muted">
                                            <p class="h6 mb-1">Telah diterima pembayaran dari :</p>
                                            <p class="mb-1 fw-bold text-uppercase fst-italic" style="font-size: 1rem"> {{ $payment->user->name }}</p>
                                            <p class="mb-0 fst-italic">{{ $payment->user->no_kontak }}</p>
                                            <p class="mb-0 text-capitalize fst-italic">{{ $payment->user->alamat }}</p>
                                        </div>
                                    </div>
                                    {{-- col 2 --}}
                                    <div class="col-sm-6" style="font-size: 0.8rem">
                                        <div class="text-muted text-sm-end">
                                            <p class="h6 fw-bold mb-1">Kode Pembayaran</p>
                                            <p class="fst-italic text-uppercase mb-2" style="font-size: 1rem">{{ $payment->payment_code }}</p>
                                            <p class="h6 fw-bold mb-1">Tanggal Pembayaran</p>
                                            <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ \Carbon\Carbon::parse($payment->payment_date)->isoFormat('dddd, D MMMM Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- order sumary --}}
                                <div class="py-2 mt-2">
                                    <div class="table-responsive">
                                        <p class="fst-italic" style="font-size: 1rem">Dengan detail pre order box sebagai berikut :</p>
                                        <table class="table align-middle nowrap mb-0" style="font-size: 0.8rem">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="text-center">Nama PO</th>
                                                    <th class="text-center">Jenis Box</th>
                                                    <th class="text-center">Status Bayar</th>
                                                    <th class="text-center">Metode Bayar</th>
                                                    <th class="text-center">Daftar Bahan</th>
                                                    <th class="text-end">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center text-uppercase">{{ $payment->production->pre_order }}</td>
                                                    <td class="text-center text-uppercase">{{ $payment->production->jenis_box }}</td>
                                                    <td class="text-center text-uppercase">
                                                        @if ($payment->status_payment == 'DOWN PAYMENT')
                                                            <span>down payment</span>
                                                        @elseif ($payment->status_payment == 'DOWN PAYMENT/PAID')
                                                            <span>down payment</span>
                                                        @elseif ($payment->status_payment == 'PELUNASAN/PAID')
                                                            <span>pelunasan</span>
                                                        @else
                                                            <span>full payment</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center text-uppercase">{{ $payment->payment_method }}</td>
                                                    <td class="text-center">
                                                        @forelse($production_tools as $bahan)
                                                        <span class="text-muted text-capitalize"> {{ $bahan->tool_name }}, </span>
                                                        @empty
                                                        <span class="text-muted text-capitalize">tidak ada bahan terpakai</span>
                                                        @endforelse
                                                    </td>
                                                    <td class="text-end">Rp {{ number_format($payment->payment_amount, 0, ',','.') }}</td>
                                                    @php
                                                    //simple tax math
                                                    $vat_tax = 0.1;
                                                    $taxable_payment = $payment->payment_amount;
                                                    $tax = $vat_tax * $taxable_payment;
                                                    $without_tax = $taxable_payment - $tax;
                                                    @endphp
                                                </tr>
                                                <tfoot>
                                                    <tr class="fw-bold fst-italic">
                                                        <td></td>
                                                        <td colspan="3" class="text-end">Subtotal</td>
                                                        <td colspan="2" class="text-end">Rp {{ number_format($without_tax, 0, ',','.') }}</td>
                                                    </tr>
                                                    <tr class="fw-bold fst-italic">
                                                        <td></td>
                                                        <td colspan="3" class="text-end">Pajak 10%</td>
                                                        <td colspan="2" class="text-end">Rp {{ number_format($tax, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr class="fw-bold fst-italic" style="font-size: 1.25rem">
                                                        <td></td>
                                                        <td colspan="3" class="text-end">*Total Pembayaran</td>
                                                        <td colspan="2" class="text-end">Rp {{ number_format($taxable_payment, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- footer --}}
                                <div class="mt-5 mb-5">
                                    <div class="p-2" style="border-left: 10px solid #85bde8;">
                                        <p class="fst-italic mb-0">NB:</p>
                                        <p class="fst-italic text-muted fw-bold" style="font-size: 0.8rem">*Harga Pre Order Box Sudah Termasuk Pajak PPN Sebesar 10%</p>
                                    </div>
                                </div>
                                {{-- sign --}}
                                <div class="row mt-1" style="font-size: 0.8rem">
                                    <div class="col-sm-6">
                                        <div class="text-center">
                                            <p class="fw-bold">Hormat Kami,</p>
                                            <br><br>
                                            <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ auth()->user()->name; }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-center">
                                            <p class="fw-bold">Penyewa,</p>
                                            <br><br>
                                            <p class="fw-bold text-capitalize" style="font-size: 1rem">{{ $payment->user->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row fst-italic">
                                    <footer class="text-muted text-end" style="font-size: 0.75rem;">
                                        Nota Dicetak Otomatis pada Hari {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }} Pukul {{ Carbon\Carbon::now()->isoFormat('HH:mm:ss') }}
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end m-3">
            <a href="{{ route('cetak.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</section>


@endsection