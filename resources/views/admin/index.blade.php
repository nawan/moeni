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
        <li class="breadcrumb-item" aria-current="page">Admin</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.index') }}">Data Admin</a></li>
    </ol>
</nav>

<section class="content">
    <div class="card mt-10 mb-5">
        <div class="card-header text-center fw-bold text-uppercase mb-10 bg-dark text-white">
            Data Admin
        </div>
        <div class="card-body">
            <div class="d-flex mt-4 mb-3">
                <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Tambah Admin</a>
            </div>
            <div class="justify-content-center">
                <form action="{{ route('admin.index') }}" method="GET">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" value="{{ Request::input('search') }}" class="form-control" placeholder="Nama Admin..." name="search">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover mb-2">
                    <thead class="thead-light">
                        <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">No Kontak</th>
                        <th scope="col">Terdaftar Sejak</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($admins as $admin)
                        <tr class="text-center">
                            <th scope="row" class="align-middle">{{ $loop->iteration }}</th>
                            <td class="align-middle">
                                <div class="position-relative text-capitalize">
                                    {{ $admin->name }}
                                    @if($admin->is_admin == '1')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        admin
                                        
                                    </span>
                                    @elseif($admin->is_admin == '2')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                        supervisor
                                        
                                    </span>
                                    @elseif($admin->is_admin == '3')
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        staff
                                    </span>
                                    @endif
                                </div>
                                <div style="visibility: hidden">{{ $admin->is_admin }}</div>
                            </td>
                            <td>
                                @if($admin->image)  
                                <img src="{{ asset('storage/' . $admin->image) }}" width="75" alt="">
                                @else
                                <img src="{{ $admin->gravatar }}" width="50" class="rounded-circle" alt="">
                                @endif
                            </td>
                            <td class="align-middle">
                                {{ $admin->email }}
                            </td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($admin->created_at)->diffForHumans() }}
                            </td>
                            <td class="align-middle">
                                @php $encryptID = Crypt::encrypt($admin->id); @endphp
                                @if($admin->is_admin == '1')
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $admin->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                @elseif(Auth::user()->is_admin == '1')
                                    {{-- <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deleteConfirm(event)"><i class="fa fa-trash"></i></button>
                                    </form> --}}
                                    <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{ route('admin.edit',$encryptID) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $admin->id }}">
                                        <i class="fa fa-eye"></i>
                                        </button>
                                @elseif(Auth::user()->is_admin == '2')
                                    {{-- <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deleteConfirm(event)"><i class="fa fa-trash"></i></button>
                                    </form> --}}
                                    <form method="POST" action="{{ route('admin.destroy', $admin->id) }}" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{ route('admin.edit',$encryptID) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $admin->id }}">
                                        <i class="fa fa-eye"></i>
                                        </button>
                                @else
                                    
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Info" data-bs-toggle="modal" data-bs-target="#detail{{ $admin->id }}">
                                        <i class="fa fa-eye"></i></button>
                                @endif
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail{{ $admin->id }}" tabindex="-1" aria-labelledby="detail{{ $admin->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="card mt-10">
                                            <div class="card-header text-center fw-bold text-uppercase mb-10 bg-info text-white">
                                                    Detail Data Admin
                                            </div>
                                            <div class="card-group bg-light mt-10">
                                                <div class="card">
                                                    <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                        Foto Profil
                                                    </div>
                                                    <div class="card-body text-center" style="400px">
                                                        <p class="card-title text-capitalize fw-bold mb-3 h4">
                                                            @if($admin->image)  
                                                            <img src="{{ asset('storage/' . $admin->image) }}" class="rounded mx-auto" width="400" alt="">
                                                            @else
                                                            <img src="{{ $admin->gravatar }}" class="rounded mx-auto" width="400" alt="">
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header text-center text-uppercase fw-bold mb-3">
                                                        Data Admin
                                                    </div>
                                                    <div class="cad-body text-center mb-3" style="400px">
                                                        <p class="card-text fw-bold m-0">Nama</p>
                                                        <p class="fst-italic text-capitalize mb-2">{{ $admin->name }}</p>
                                                        <p class="card-text fw-bold m-0">NIK</p>
                                                        <p class="fst-italic text-uppercase mb-2">{{ $admin->nik }}</p>
                                                        <p class="card-text fw-bold m-0">No Kontak</p>
                                                        <p class="fst-italic text-uppercase mb-2"><a href="https://wa.me/" target="_blank">{{ $admin->no_kontak  }}</a></p>
                                                        <p class="card-text fw-bold m-0">Email</p>
                                                        <p class="fst-italic mb-2">{{ $admin->email }}</p>
                                                        <p class="card-text fw-bold m-0">Alamat</p>
                                                        <p class="fst-italic text-capitalize mb-2">{{ $admin->alamat }}</p>
                                                        <p class="card-text fw-bold m-0">Terdaftar Sejak</p>
                                                        <p class="fst-italic mb-2">{{ \Carbon\Carbon::parse($admin->created_at)->diffForHumans() }}</p>
                                                        <button type="button" class="btn btn-info btn-sm mb-3"><a href="{{ route('admin.show', $encryptID) }}" class="text-white" style="text-decoration: none">Lihat Detail</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
    
                    @empty
                    <tr>
                        <td colspan="6" class="text-center mt-2 mb-2">
                            <span class="fst-italic">Data Tidak Ditemukan</span><br><br>
                            <a href="{{ route('admin.index') }}" class="btn btn-info btn-sm"><i class="fa fa-recycle"></i> Refresh</a>
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $admins->links() }}
        </div>
    </div>
</section

@endsection