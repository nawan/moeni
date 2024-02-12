@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- core menu --}}
                <div class="sb-sidenav-menu-heading">Beranda</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Dashboard
                </a>
                {{-- data menu --}}
                <div class="sb-sidenav-menu-heading">Data</div>
                {{-- menu data client --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClient" aria-expanded="false" aria-controls="collapseClient">
                    <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                    Client
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseClient" aria-labelledby="headingClient" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('client.create') }}">
                            Tambah Client
                        </a>
                        <a class="nav-link collapsed" href="{{ route('client.index') }}">
                            Data Client
                        </a>
                    </nav>
                </div>
                {{-- menu data tukang --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTukang" aria-expanded="false" aria-controls="collapseTukang">
                    <div class="sb-nav-link-icon"><i class="fa fa-user-cog"></i></div>
                    Tukang
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTukang" aria-labelledby="headingTukang" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('tukang.create') }}">
                            Tambah Tukang
                        </a>
                        <a class="nav-link collapsed" href="{{ route('tukang.index') }}">
                            Data Tukang
                        </a>
                    </nav>
                </div>
                {{-- menu data admin --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">
                    <div class="sb-nav-link-icon"><i class="fa fa-user-check"></i></div>
                    Admin
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmin" aria-labelledby="headingAdmin" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('admin.create') }}">
                            Tambah Admin
                        </a>
                        <a class="nav-link collapsed" href="{{ route('admin.index') }}">
                            Data Admin
                        </a>
                    </nav>
                </div>
                {{-- menu data bahan --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBahan" aria-expanded="false" aria-controls="collapseBahan">
                    <div class="sb-nav-link-icon"><i class="fa fa-warehouse"></i></div>
                    Database Bahan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseBahan" aria-labelledby="headingBahan" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('bahan.create') }}">
                            Tambah Bahan
                        </a>
                        <a class="nav-link collapsed" href="{{ route('bahan.index') }}">
                            Data Bahan
                        </a>
                        <a class="nav-link collapsed" href="{{ route('bahan.habis') }}">
                            Bahan Habis
                        </a>
                    </nav>
                </div>
                {{-- menu data production --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduksi" aria-expanded="false" aria-controls="collapseProduksi">
                    <div class="sb-nav-link-icon"><i class="fa fa-bookmark"></i></div>
                    Produksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProduksi" aria-labelledby="headingProduksi" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('production.create') }}">
                            Tambah PO
                        </a>
                        <a class="nav-link collapsed" href="{{ route('production.index') }}">
                            Data PO
                        </a>
                        <a class="nav-link collapsed" href="{{ route('production.proses') }}">
                            Status PO
                        </a>
                    </nav>
                </div>
                {{-- menu data payment --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePayment" aria-expanded="false" aria-controls="collapsePayment">
                    <div class="sb-nav-link-icon"><i class="fa fa-dollar-sign"></i></div>
                    Billing
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePayment" aria-labelledby="headingPayment" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('payment.index') }}">
                            Pembayaran 
                        </a>
                        <a class="nav-link collapsed" href="{{ route('payment.history') }}">
                            Riwayat
                        </a>
                    </nav>
                </div>
                {{-- menu cetak --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCetak" aria-expanded="false" aria-controls="collapseCetak">
                    <div class="sb-nav-link-icon"><i class="fa fa-print"></i></div>
                    Cetak
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCetak" aria-labelledby="headingCetak" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('cetak.index') }}">
                            Bukti Bayar 
                        </a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Profil</div>
                {{-- menu profil --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Profil Saya
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseProfil" aria-labelledby="headingSeven" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('profile') }}">
                            Edit Profil
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Username Anda:</div>
            <span class="text-lg" style="text-transform:capitalize">
                {{ auth()->user()->name; }}
            </span>
        </div>
    </nav>
</div>