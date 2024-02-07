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
<script>
    $(document).ready(function() {
    $('#status_bahan').change(function() {
        if ($(this).val() == 'OUT OF STOCK') {
            $("input[name='jml_stok']").prop('readonly',true);
            document.querySelector('input[name="jml_stok"]').value = '0'
        }else{
            $("input[name='jml_stok']").prop('readonly',false);
        };     
    }); 
});
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
        <li class="breadcrumb-item" aria-current="page">Database Bahan</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
    </ol>
</nav>

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
        Edit Data Bahan {{ $bahan->name }}
    </div>
    <div class="card-group">
        <div class="card-body">
            <form action="{{ route('bahan.update', $bahan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf()
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name" class="form-label">Nama bahan</label>
                        <input type="text" class="form-control count-chars text-uppercase @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $bahan->name) }}" maxlength="50" data-max-chars="50">
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="price" class="form-label">Harga Bahan</label>
                        <div class="input-group">
                            <div class="input-group-text">Rp</div>
                            <input type="text" class="form-control count-chars @error('price') is-invalid @enderror" name="price" id="currency" value="{{ number_format($bahan->price, 0, ',', '.') }}" maxlength="15" data-max-chars="15">
                        </div>
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('price')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 mb-3">
                        <label for="jml_stok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control count-chars text-uppercase @error('jml_stok') is-invalid @enderror" id="jml_stok" name="jml_stok" value="{{ old('jml_stok', $bahan->jml_stok) }}" maxlength="20" data-max-chars="20">
                        <div class="fw-light text-muted justify-content-end d-flex"></div>
                        @error('jml_stok')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 mb-3">
                        <label for="status_bahan" class="form-label">Status Bahan</label>
                        <select class="form-select @error('status_bahan') is-invalid @enderror" id="status_bahan" name="status_bahan">
                            <option value="">---Silahkan Pilih---</option>
                            <option value="READY STOCK">Ready Stock</option>
                            <option value="OUT OF STOCK">Out Of Stock</option>
                        </select>
                        @error('status_bahan')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto_bahan" class="form-label">Foto Bahan</label>
                    <input type="hidden" name="oldFoto_bahan" value="{{ $bahan->foto_bahan }}">
                    @if($bahan->foto_bahan)
                    <img src="{{ asset('storage/' . $bahan->foto_bahan) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" width="400" alt=""> 
                    @else
                    <img src="" class="img-preview img-fluid mb-3 col-sm-5" alt="">
                    @endif
                    <input class="form-control @error('foto_bahan') is-invalid @enderror" type="file" id="image" name="foto_bahan" onchange="previewImage()" value="{{ old('foto_bahan', $bahan->foto_bahan) }}">
                    @error('foto_bahan') 
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 card-text">
                    <label for="note" class="form-label">Catatan</label>
                    <textarea rows="8" name="note" id="note-editor" class="form-control count-chars @error('note') @enderror" maxlength="600" data-max-chars="600">{{ old('note', $bahan->note) }}</textarea>
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('note')
                    <span class="invalid-feedback">
                    {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="mb-3 card-text">
                    <label for="deskripsi" class="form-label">Deskripsi Bahan</label>
                    <textarea rows="10" name="deskripsi" id="deskripsi-editor" class="form-control count-chars @error('deskripsi') @enderror" maxlength="600" data-max-chars="600">{{ old('deskripsi', $bahan->deskripsi) }}</textarea>
                    <div class="fw-light text-muted justify-content-end d-flex"></div>
                    @error('deskripsi')
                    <span class="invalid-feedback">
                    {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="{{ route('bahan.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection