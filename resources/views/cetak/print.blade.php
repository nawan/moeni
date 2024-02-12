



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bukti Bayar PO</title>
        {{-- bootstrap@5.3.0-alpha3 css --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <style>
            @media print{
                @page {size: A4 potrait;}
            }
        </style>
    </head>
    <body>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- company title receipt --}}
                    <div class="invoice-title">
                        <div class="mb-2">
                            <img src="{{ URL::asset('/assets/img/google.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="200px" />
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
                            <p class="fst-italic" style="font-size: 1rem">Dengan detail sewa alat sebagai berikut :</p>
                            <table class="table align-middle nowrap mb-0" style="font-size: 0.8rem">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="text-center">Nama PO</th>
                                        <th class="text-center">Jenis Box</th>
                                        <th class="text-center">Metode Bayar</th>
                                        <th class="text-center">Daftar Bahan</th>
                                        <th class="text-end">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center text-uppercase">{{ $payment->production->pre_order }}</td>
                                        <td class="text-center text-uppercase">{{ $payment->production->jenis_box }}</td>
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
        <script>
            window.print();
        </script>
    </body>
    @stack('script')
</html>