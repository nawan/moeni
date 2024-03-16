<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Moeni Box</title>
    <link rel="icon" type="image" href="{{ URL::asset('/assets/img/logo.png') }}">
</head>
<style>
    body {  
        /* background: radial-gradient(circle, rgba(0,8,251,0.9854442265187325) 0%, rgba(29,28,117,1) 0%, rgba(15,15,15,1) 100%); !important;   */
        /* background-image: url('../assets/img/bg.jpg'); */
        font-family: 'Muli', sans-serif;
        height: 100%;  
    } 
    h1 {  
        color: #fff;  
        padding-bottom: 2rem;  
        font-weight: bold;  
    }  
    a {  
        color: #333;  
    }  
    a:hover {  
        color: #E8D426;  
        text-decoration: none;  
    }
    .form-control:focus {  
        color: #000;  
        background-color: #fff;  
        border: 2px solid #E8D426;  
        outline: 0;  
        box-shadow: none;  
    }  
    .btn {  
        background: #28a745;  
        border: #E8D426;  
    }  
    .btn:hover {  
        background: #28a745;  
        border: #E8D426;  
    }
    .text-main {
        color: rgb(244, 248, 24);
    }
    .transparent {
        opacity: 0.7;
    }  
</style>
<!-- Font Awesome -->
<link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="css/bg.css">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('/assets/bootstrap-5/css/bootstrap.min.css') }}" />
<body class="bg-login">
    <div class="pt-5">  
        <div class="container-fluid">  
            <div class="row pt-5">  
                <div class="col-md-5 col-lg-4 col-sm-6 mx-auto pt-5">
                    <div class="card align-middle bg-dark transparent rounded-full">
                        <div class="card-header fw-bold text-center text-capitalize text-light mb-2">
                            <h5>login dashboard admin PO</h5>
                        </div>
                        <div class="card-body bg-dark mb-3" style="opacity:initial">
                            <div class="text-center mb-5">
                                <img src="{{ URL::asset('/assets/img/logo.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="250px" />
                            </div>
                            <form id="submitForm" action="{{ route('login') }}" method="post" data-parsley-validate="" data-parsley-errors-messages-disabled="true" novalidate="" _lpchecked="1">  
                                @csrf
                                <div class="input-group mb-1">
                                    <div class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                    </div>
                                    <x-text-input id="email" class="form-control bg-dark text-white" type="email" name="email" :value="old('email')" placeholder="example@email.com" required autofocus autocomplete="username" style="height: 60px;" />
                                </div>
                                <div class="input-group mb-3">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
                                <div class="input-group mb-1" id="show_hide_password">
                                    <div class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16">
                                            <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2"/>
                                        </svg>
                                    </div>
                                    <x-text-input id="password" class="form-control bg-dark text-white"
                                    type="password"
                                    name="password" 
                                    placeholder="password"
                                    id="password"
                                    required autocomplete="current-password" style="height: 60px;" />
                                    <div class="input-group-text text-light bg-dark" style="border-left: none; cursor: pointer;">
                                        <i class="fa fa-eye-slash" aria-hidden="true" style="font-size: 25px"></i>
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group text-end">  
                                    <button class="btn btn-light fw-bold btn-lg" type="submit">Login</button>  
                                </div>  
                            </form>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
</body>
<!-- jQuery -->
<script src="assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/bootstrap.min.js') }}"></script>
{{-- bootstrap password jscript --}}
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap-5/js/bootstrap-show-password.min.js') }}"></script>
<script>
    $(document).ready(function() {
    $("#show_hide_password i").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye text-main" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye text-main" );
        }
    });
});
</script>
</html>

