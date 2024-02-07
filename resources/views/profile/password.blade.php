@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
{{-- sweet alert2 css --}}
<link rel="stylesheet" href="{{ URL::asset('assets/sweet-alert/css/sweetalert2.min.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
{{-- position of the icon eye password --}}
<style>
.field-icon {
    float: right;
    /* margin-left: -25px; */
    margin-right: 15px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
    cursor: pointer;
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
{{-- bootstrap@5.3.0-alpha3 jscript --}}
{{-- <script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script> --}}
<script>
    $(function(){
    
    $('.eyes').click(function(){
        
            if($(this).hasClass('fa-eye-slash')){
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('.password').attr('type','text');    
            }
            else{
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');  
            $('.password').attr('type','password');
            }
        });
    });
</script>
@endpush

@extends('layouts.main')

@section('content')
<nav aria-label="breadcrumb" class="navbar navbar-light bg-light mb-4 mt-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb my-auto p-2">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home mt-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
    </ol>
</nav>

@if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="card mt-10 mb-5">
    <div class="card-header text-center fw-bold text-uppercase mb-10 bg-warning text-white">
    Ganti Password
    </div>
    <div class="card-group">
        <div class="card-body">
            <form action="{{ route('change-password.change') }}" method="POST" enctype="multipart/form-data">
                @csrf()
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Password Lama</label>
                        <input type="password" required class="form-control password @error('old_password') is-invalid @enderror" name="old_password" id="old_password" >
                        <i class="fas fa-eye-slash field-icon text-secondary eyes"></i>
                        @error('old_password')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" required class="form-control password @error('password') is-invalid @enderror" name="password" id="password" >
                        <i class="fas fa-eye-slash field-icon text-secondary eyes"></i>
                        @error('password')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" required class="form-control password @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" >
                        <i class="fas fa-eye-slash field-icon text-secondary eyes"></i>
                        @error('password_confirmation')
                        <span class="invalid-feedback">
                        {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@push('script')

{{-- preview image script --}}
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
{{-- sweet alert success notification --}}
@if(Session::has('message'))
<script>
    swal("Sukses","{{ Session::get('message') }}", 'success',{
        button:true,
        button:"OK",
        timer:false,
    });
</script>
@endif
{{-- validation form --}}
<script type="text/javascript" src="{{ URL::asset('js/form-validation.js') }}"></script>
{{-- show and hidden eye icon script --}}
@endpush
@endsection