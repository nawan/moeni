<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-2" href="{{ route('dashboard') }}"><img src="{{ URL::asset('/assets/img/logo.png') }}" alt="logo" height="40px" width="auto"></a>
    <!-- Sidebar Toggle-->
    <button class="order-1 btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="my-2 d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-md-0">
    </form>
    <!-- Navbar-->
    <p class="text-secondary text-bg-light text-capitalize text-xs p-2 my-auto d-none d-lg-block">Hallo, {{ auth()->user()->name; }}</p>
    <ul class="navbar-nav d-flex justify-content-between ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset('storage/' .auth()->user()->image) }}" width="25" class="rounded-circle" alt=""></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Edit Profil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form method="POST" class="dropdown-item" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt"></i>
                                                {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>