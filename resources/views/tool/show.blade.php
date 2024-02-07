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
        <li class="breadcrumb-item" aria-current="page">Database Bahan</li>
        <li class="breadcrumb-item active" aria-current="page">Detail Bahan</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
        Detail Data Bahan
    </div>
    <div class="card-group bg-light mt-10">
        <div class="card-body text-center col-md-6">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Foto Bahan
            </div>
            <div class="card-body bg-white p-5" style="width:100%;max-heigth:600px">
                <img src="{{ asset('storage/' . $bahan->foto_bahan) }}" class="rounded img-thumbnail" width="500" data-bs-toggle="modal" data-bs-target="#detail-foto" style="cursor: pointer">
            </div>
        </div>

        {{-- modal view show image --}}
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail-foto" tabindex="-1" aria-labelledby="Foto Bahan {{ $bahan->name }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent" style="border: none">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close-white" data-bs-dismiss="modal"><i class="fa" style="font-size: 2rem;">&#xf00d;</i></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $bahan->foto_bahan) }}" style="width:100%;max-width:600px">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body text-center col-md-6">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Data bahan
            </div>
            <div class="card-body bg-white p-3" style="width:100%;max-heigth:600px">
                <p class="card-text fw-bold m-0">Nama Bahan</p>
                <p class="fst-italic text-capitalize mb-2">{{ $bahan->name }}</p>
                <p class="card-text fw-bold m-0">Kode Bahan</p>
                <p class="fst-italic text-capitalize mb-2">{{ $bahan->kode_bahan }}</p>
                <p class="card-text fw-bold m-0">Harga Sewa</p>
                <p class="fst-italic text-capitalize mb-2">Rp {{ number_format($bahan->price, 0, ',', '.') }}</p>
                <p class="card-text fw-bold m-0">Status Bahan</p>
                <p class="fst-italic text-uppercase mb-2">
                    @if($bahan->status_bahan == 'READY STOCK')
                    <span class="badge bg-success text-uppercase">READY STOCK</span>
                    @else
                    <span class="badge bg-danger text-uppercase">OUT OF STOCK</span>
                    @endif
                </p>
                <p class="card-text fw-bold m-0">Tanggal Registrasi Bahan</p>
                <p class="fst-italic text-capitalize mb-2">{{ \Carbon\Carbon::parse($bahan->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                <div class="d-flex justify-content-end mt-2">
                    @php $encryptID = Crypt::encrypt($bahan->id); @endphp
                    <a href="{{ route('bahan.edit', $encryptID) }}"class="btn btn-sm btn-warning m-1" title="Edit Bahan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Note
            </div>
            <div class="card-body bg-white p-3" style="width:100%; max-heigth:500px">
                <p class="fst-italic text-capitalize mb-2">{!! html_entity_decode($bahan->note, ENT_QUOTES, 'UTF-8' ) !!}</p>
            </div>
        </div>
        <div class="card-body col-md-12">
            <div class="card-header text-center text-uppercase fw-bold bg-secondary text-white">
                Spesifikasi
            </div>
            <div class="card-body bg-white p-3" style="width:100%; max-heigth:500px">
                <p class="fst-italic text-capitalize mb-2">{!! html_entity_decode($bahan->deskripsi, ENT_QUOTES, 'UTF-8' ) !!}</p>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-3">
        <a href="{{ route('bahan.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>

@endsection