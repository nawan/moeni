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
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item" aria-current="page">Client</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Client</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
        Edit Data Client Atas Nama {{ $client->name }}
    </div>
    <div class="card-group">
        <div class="card-body">
            <form action="{{ route('client.update', $client->id) }}" method="POST" enctype="multipart/form-data">
            @csrf()
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control text-uppercase count-chars @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $client->name) }}" maxlength="20" data-max-chars="20">
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="number" class="form-control count-chars @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $client->nik) }}" maxlength="16" data-max-chars="16">
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('nik')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="no_kontak" class="form-label">No Kontak/HP</label>
                    <input type="number" class="form-control count-chars @error('no_kontak') is-invalid @enderror" id="no_kontak" name="no_kontak" value="{{ old('no_kontak', $client->no_kontak) }}" readonly>
                    @error('no_kontak')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $client->email) }}" readonly>
                    @error('email')
                    <span class="invalid-feedback">
                    {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Foto</label>
                <input type="hidden" name="oldImage" value="{{ $client->image }}">
                @if($client->image)
                <img src="{{ asset('storage/' . $client->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" alt=""> 
                @else
                <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt="">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea rows="5" name="alamat" id="alamat" class="form-control text-capitalize count-chars @error('alamat') @enderror" maxlength="100" data-max-chars="100">{{ old('alamat', $client->alamat) }}</textarea>
                <div class="fw-light text-muted justify-content-end d-flex"></div>
                @error('alamat')
                <span class="invalid-feedback">
                {{ $message }}
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-end mt-3 gap-2">
                <a href="{{ route('client.index') }}" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection