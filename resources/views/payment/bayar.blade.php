@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
{{-- font awesome css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/fontawesome/css/all.css') }}">
@endpush

@push('script')
{{-- sweet alert2 js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert2.all.min.js') }}"></script>
{{-- sweet alert js --}}
<script type="text/javascript" src="{{ URL::asset('assets/sweet-alert/js/sweetalert.min.js') }}"></script>
{{-- jquery jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery.min.js') }}"></script>
{{-- bootstrap password jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap-show-password.min.js') }}"></script>
{{-- currency script --}}
<script type="text/javascript" src="{{ URL::asset('js/currency.js') }}"></script>
<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
        }
    }
</script>
{{-- validation form --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('note-editor');
</script>
<script type="text/javascript">
    CKEDITOR.replace('deskripsi-editor');
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Pembayaran</li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('payment.index') }}">Data Bayar</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">Bayar</a></li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
        Formulir Pembayaran Order {{ $production->jenis_box }}
    </div>
    <div class="card-group">
        <div class="card-body">
            <form action="{{ route('payment.store', $production->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf()
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
                        <div class="row mb-3 card-text">
                            <div class="form-group col-md-6" style="display:none">
                                <input type="text" class="form-control text-capitalize count-chars @error('user_id') is-invalid @enderror" id="user_id" name="user_id" value="{{ old('user_id', $production->user_id) }}" maxlength="20" data-max-chars="20" hidden>
                                @error('user_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="display:none">
                                <input type="text" class="form-control text-capitalize count-chars @error('production_id') is-invalid @enderror" id="production_id" name="production_id" value="{{ old('production_id', $production->id) }}" maxlength="20" data-max-chars="20" hidden>
                                @error('production_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="display: none">
                                <input type="text" class="form-control text-capitalize count-chars @error('received_by') is-invalid @enderror" id="received_by" name="received_by" value="{{ auth()->user()->id; }}" maxlength="20" data-max-chars="20" hidden>
                                @error('received_by')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6" style="display: none">
                                <input type="text" class="form-control text-capitalize count-chars @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{ $production->total_price }}" maxlength="20" data-max-chars="20" hidden>
                                @error('total_price')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 card-text">
                            <div class="form-group col-md-4">
                                <label for="status_payment" class="form-label">Jenis Pembayaran</label>
                                <select class="form-select @error('status_payment') is-invalid @enderror" id="status_payment" name="status_payment">
                                    <option value="">-- Pilih Jenis Pembayaran --</option>
                                    <option value="DOWN PAYMENT">Down Payment</option>
                                    <option value="PAID">Full Payment</option>
                                </select>
                                @error('status_payment')
                                <span class="invalid-feedback">
                                    Jenis Pembayaran tidak boleh kosong
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="TUNAI">Tunai</option>
                                    <option value="TRANSFER">Transfer Bank</option>
                                    <option value="QRIS">QRIS GPN</option>
                                </select>
                                @error('payment_method')
                                <span class="invalid-feedback">
                                    Metode Pembayaran tidak boleh kosong
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="payment_date" class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('payment_date') is-invalid @enderror" name="payment_date" id="payment_date" value="{{ old('payment_date') }}">
                                @error('payment_date')
                                <span class="invalid-feedback">
                                    Tanggal Pembayaran tidak boleh kosong
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 card-text">
                            <div class="form-group col-md-4">
                                <label for="payment_amount" class="form-label">Nominal Diterima</label>
                                <div class="input-group">
                                    <div class="input-group-text">Rp</div>
                                    <input type="text" class="form-control count-chars @error('payment_amount') is-invalid @enderror" name="payment_amount" id="currency" value="{{ old('payment_amount') }}" maxlength="15" data-max-chars="15">
                                </div>
                                <div class="fw-light text-muted justify-content-end d-flex"></div>
                                @error('payment_amount')
                                <span class="invalid-feedback">
                                    Nominal Pembayaran tidak boleh kosong
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-8">
                                <label for="payment_proof" class="form-label">Foto Bukti Pembayaran</label>
                                <img src="" class="mb-3 img-preview img-fluid col-sm-5" alt="">
                                <input class="form-control @error('payment_proof') is-invalid @enderror" type="file" id="image" name="payment_proof" onchange="previewImage()">
                                @error('payment_proof') 
                                <div class="invalid-feedback">
                                    Bukti Pembayaran tidak boleh kosong
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 card-text" style="display:none">
                            <label for="payment_code">Payment Code</label>
                                @php
                                    $length = 4;    
                                    $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                    $num =  substr(str_shuffle('0123456789'),1,$length);
                                @endphp
                            <input type="text" required name="payment_code" value="WHP-N-@php echo $alph_num;@endphp-@php echo $num;@endphp " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        <a href="{{ route('payment.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection