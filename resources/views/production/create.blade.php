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
        <li class="breadcrumb-item" aria-current="page">Produksi</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('production.create') }}">Tambah PO</a></li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-success text-white">
        Tambah PO
    </div>
    <div class="card-group">
        <div class="card-body">
            <form action="{{ route('production.store') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="mb-3 card-text form-group col-md-4">
                        <label for="user_id" class="form-label">Nama Client</label>
                        <select class="form-select text-capitalize" id="user_id" name="user_id">
                        <option value="">---Silahkan Pilih---</option>
                        @foreach($users as $user)
                        <option {{ (old('user_id') == $user->id ? 'selected' : '') }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="pre_order" class="form-label">Jenis PO</label>
                        <select class="form-select" id="pre_order" name="pre_order">
                            <option value="">---Silahkan Pilih---</option>
                            <option value="BARU">Baru</option>
                            <option value="REPARASI">Reparasi</option>
                            <option value="UPGRADE">Upgrade</option>
                            <option value="OTHER">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="status_proses" class="form-label">Proses</label>
                        <select class="form-select" id="status_proses" name="status_proses">
                            <option value="">---Silahkan Pilih---</option>
                            <option value="DESIGNING">Designing</option>
                            <option value="MACHINING">Machining</option>
                            <option value="ASSEMBLING">Assembling</option>
                            <option value="PAINTING">Painting</option>
                            <option value="INSTALLATION">Installation</option>
                            <option value="TUNING">Tuning</option>
                            <option value="PACKING">Packing</option>
                            <option value="DELIVERY">Delivery</option>
                        </select>
                    </div>
                </div>
                <div class="form-group card-text col-md-12 mb-3">
                    <label for="jenis_box" class="form-label">Jenis Box</label>
                    <input type="text" class="form-control count-chars @error('jenis_box') is-invalid @enderror" id="jenis_box" name="jenis_box" value="{{ old('jenis_box') }}" maxlength="30" data-max-chars="30">
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('jenis_box')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group card-text col-md-12 mb-3">
                    <label for="note" class="form-label">Catatan</label>
                    <textarea rows="8" name="note" id="note-editor" class="form-control count-chars @error('note') @enderror" maxlength="600" data-max-chars="600">{{ old('note') }}</textarea>
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('note')
                    <span class="invalid-feedback">
                    {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="{{ route('production.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection