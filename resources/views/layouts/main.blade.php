<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Moeni</title>
        <link rel="icon" type="image" href="{{ URL::asset('/assets/img/logo.png') }}">
        {{-- bootstrap@5.3.0-alpha3 css --}}
        <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap-5/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
        {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> --}}
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        @stack('style')
    </head>
    <body class="sb-nav-fixed bg-secondary-slate">
        @include('includes.navbar')
        <div id="layoutSidenav">
            @if(auth()->user()->is_admin == '4')
                @include('includes.sidebarTukang')
            @elseif(auth()->user()->is_admin == '3')
                @include('includes.sidebarStaff')
            @elseif(auth()->user()->is_admin == '2')
                @include('includes.sidebarSupervisor')
            @else
                @include('includes.sidebar')
            @endif
            <div id="layoutSidenav_content">
                <main>
                    <div>
                        @yield('breadcrumb')
                    </div>
                    <div class="px-4 container-fluid">
                        @yield('content')
                    </div>
                </main>
                @include('includes.footer')
            </div>
        </div>
        {{-- bootstrap@5.3.0-alpha3 jscript --}}
        <script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        {{-- <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
        {{-- jquery jscript --}}
        {{-- <script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery-3.6.4.slim.js') }}"></script> --}}
        {{-- jquery jscript --}}
        <script type="text/javascript" src="{{ URL::asset('assets/jquery/jquery.min.js') }}"></script>
    </body>
    @stack('script')
</html>