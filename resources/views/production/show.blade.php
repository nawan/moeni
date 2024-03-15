@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
<style>
        .tooltips {
    position: relative;
    display: inline-block;
    }

    .tooltips .tooltiptext {
    visibility: hidden;
    width: 140px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 150%;
    left: 50%;
    margin-left: -75px;
    opacity: 0;
    transition: opacity 0.3s;
    }

    .tooltips .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    }

    .tooltips:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
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

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    function showGenerate() {
        var x = document.getElementById("showElement");
        var lable = $(".btn-generate").text().trim();

        if (x.style.display === "none") {
            x.style.display = "block";
            $(".btn-generate").text("Hide Link");
        } else {
            x.style.display = "none";
            $(".btn-generate").text("Generate Link");
        }
    }
</script>
<script>
    function copyText() {
        /* Get the text field */
    var copyText = document.getElementById("myInput");
        /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999);
        /* Copy the text inside the text field */
    document.execCommand("copy");
    
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Link Copied";
    }

    function updateText() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copy URL Link";
    }
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Produksi</li>
        <li class="breadcrumb-item active" aria-current="page">Detail Data PO</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
        View Detail Data PO
    </div>
    <div class="card-body">
        <div class="card-body col-md-12">
            <div class="card-header text-white text-uppercase text-center fw-bold bg-secondary">
                {{ $production->status_proses }}
            </div>
            <div class="card-body bg-light">
                <div class="card-group">
                    <div class="card-body col-md-6">
                        <div class="card-img mt-2">
                            <img src="{{ asset('storage/' . $production->user->image) }}" class="rounded mx-auto d-block img-thumbnail mb-2" width="300" alt="">
                        </div>
                    </div>
                    <div class="card-body col-md-6">
                        <p class="card-text fw-bold mb-2">Nama Client : 
                            <span class="fw-normal text-capitalize">
                                {{ $production->user->name }}
                            </span>
                        </p>
                        <p class="card-text fw-bold mb-2">Jenis Box : 
                            <span class="fw-normal text-capitalize">
                                {{ $production->jenis_box }}
                            </span>
                        </p>
                        <p class="card-text fw-bold mb-2">Kategori Pre Order : 
                            <span class="fw-normal text-capitalize">
                                {{ $production->pre_order }}
                            </span>
                        </p>
                        <p class="card-text fw-bold mb-2">Harga Total : 
                            <span class="fw-normal text-capitalize">
                                Rp {{ number_format($production->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                        <p class="card-text fw-bold m-0">Deskripsi :</p>
                        <p class="fst-italic text-capitalize">
                            {!! html_entity_decode($production->note, ENT_QUOTES, 'UTF-8' ) !!}
                        </p>
                        <p class="card-text fw-bold m-0">
                            <button class="btn btn-sm btn-success btn-generate fw-bold" onclick="showGenerate()" title="Generate URL Link" data-toogle="tooltip" data-placement="top">Generate Link</button>
                        </p>
                        <div class="tooltips" id="showElement" style="display: none;">
                            <div class="input-group mt-2">
                                <input type="text" class="form-control" id="myInput" value="{{ $generate_url }}" maxlength="15" data-max-chars="15" readonly>
                                <button class="btn btn-sm btn-primary" onclick="copyText()" onmouseout="updateText()">
                                    <span class="tooltiptext" id="myTooltip">Copy Link</span>
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        {{-- <div class="container">
                            <div class="copy-text">
                                <input type="text" class="text" value="david@stylus.co.za" />
                                <button><i class="fa fa-clone"></i></button>
                            </div>
                        </div> --}}

                        {{-- <!-- The text field -->
                        <input type="text" value="Hello World" id="myInput">

                        <!-- The button used to copy the text -->
                        <div class="tooltips">
                        <button class="btn btn-primary" onclick="copyText()" onmouseout="updateText()">
                        <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                        Copy text
                        </button>
                        </div> --}}

                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{-- <button class="btn btn-sm btn-success" title="Generate Link" data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#showLink"><i class="fas fa-link"></i></button> --}}
                    {{-- <a href="#" class="btn btn-sm btn-success m-1" title="Generate Link" data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#showLink"><i class="fas fa-link"></i></a> --}}
                    @php $encryptID = Crypt::encrypt($production->id); @endphp
                    @if ($production->status_proses == 'DONE')
                    <a href="{{ route('production.edit', $encryptID) }}"class="btn btn-sm btn-secondary m-1 disabled" title="Edit PO" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    @else
                    <a href="{{ route('production.edit', $encryptID) }}"class="btn btn-sm btn-warning m-1" title="Edit PO" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-group">
            <div class="card-body text-center align-middle col-md-6">
                <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                    daftar bahan
            </div>
                <div class="card-body bg-light overflow-auto" style="height: 400px">
                    <table class="table text-center align-middle" style="width:100%;">
                        <thead class="thead thead-light bg-success text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Proses</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productionTools as $productionTool)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                <td class="align-middle text-capitalize">
                                    {{ $productionTool->tool_name }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $productionTool->status_proses }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    Rp {{ number_format($productionTool->price, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Masih Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        @if ($production->status_proses == 'DONE')
                        <a href="{{ route('production.tool', $encryptID) }}"class="btn btn-sm btn-secondary m-1 disabled" title="Edit PO" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @else
                        <a href="{{ route('production.tool', $encryptID) }}"class="btn btn-sm btn-warning m-1" title="Edit Bahan" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body text-center align-middle col-md-6">
                <div class="card-header text-white text-uppercase fw-bold bg-secondary">
                    daftar tukang
                </div>
                <div class="card-body bg-light overflow-auto" style="height: 400px">
                    <table class="table text-center align-middle" style="width:100%;">
                        <thead class="thead thead-light bg-success text-white table-bordered">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pekerjaan</th>
                                <th scope="col">No Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productionUsers as $productionUser)
                            <tr class="text-center">
                                <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                                <td class="align-middle text-capitalize">
                                    {{ $productionUser->user_name }}
                                </td>
                                <td class="align-middle text-capitalize">
                                    <span class="badge bg-primary fw-bold">
                                        {{ $productionUser->pekerjaan }}
                                    </span>
                                </td>
                                <td class="align-middle text-capitalize">
                                    {{ $productionUser->user->no_kontak }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Masih Kosong
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3 gap-2">
                        @if ($production->status_proses == 'DONE')
                        <a href="{{ route('production.user', $encryptID) }}"class="btn btn-sm btn-secondary m-1 disabled" title="Edit PO" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @else
                        <a href="{{ route('production.user', $encryptID) }}"class="btn btn-sm btn-warning m-1" title="Edit Tukang" data-toggle="tooltip" data-placement="top"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <a href="{{ route('production.index') }}" class="btn btn-primary">Selesai</a>
        </div>
    </div>
</div>

@endsection