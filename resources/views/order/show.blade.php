<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Order</title>
    <link rel="icon" type="image" href="{{ URL::asset('/assets/img/logo.png') }}">
</head>
<!-- Font Awesome -->
<link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="css/bg.css">
{{-- bootstrap@5.3.0-alpha3 css --}}
<link rel="stylesheet" href="{{ URL::asset('/assets/bootstrap-5/css/bootstrap.min.css') }}" />
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header text-center fw-bold text-uppercase bg-primary text-white">
                detail order
            </div>
            <div class="card-body">
                <div class="card-title text-center">
                    <div class="card-img-top mt-2 mb-2">
                        <img src="{{ URL::asset('/assets/img/logo-blue.png') }}" class="navbar-brand-img" data-holder-rendered="true" height="auto" width="200px" />
                    </div>
                    <div class="text-muted fw-bold h4">
                        MoeniBox
                    </div>
                </div>
                <hr class="my-3">
                <div class="row">
                    <div class="col-sm-6 mt-2" style="font-size: 0.8rem">
                        <div class="text-muted text-sm-start">
                            <p class="h6 mb-1">Order By :</p>
                            <p class="mb-1 fw-bold text-uppercase fst-italic" style="font-size: 1rem">{{ $production->user->name }}</p>
                            <p class="mb-0 fst-italic">{{ $production->user->no_kontak }}</p>
                            <p class="mb-0 text-capitalize fst-italic">{{ $production->user->alamat }}</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-2" style="font-size: 0.8rem">
                        <div class="text-muted text-sm-end">
                            <p class="h6 fw-bold mb-1">Order Date:</p>
                            <p class="fst-italic text-capitalize" style="font-size: 1rem">{{ \Carbon\Carbon::parse($production->created_at)->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-title fw-bold text-muted h4 mt-5 mb-2">Order Summary :</div>
                <div class="py-2 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="line">
                                    <th class="text-center"><strong>PROJECT</strong></th>
                                    <th class="text-center"><strong>STATUS</strong></th>
                                    <th class="text-center"><strong>PRICE</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>
                                            Jenis Box : {{ $production->jenis_box }}
                                        </strong><br>
                                        <small>
                                            <span class="fst-italic text-muted">{!! html_entity_decode($production->note, ENT_QUOTES, 'UTF-8' ) !!}</span>
                                        </small>
                                    </td>
                                    <td class="text-center align-middle"><span class="badge bg-primary fw-bold text-uppercase">{{ $production->status_proses }}</span></td>
                                    <td class="text-center align-middle">Rp {{ number_format($production->total_price, 0, ',','.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end bg-secondary fst-italic text-white">
                <small>
                    Update status terakhir pada {{ \Carbon\Carbon::parse($production->updated_at)->isoFormat('dddd, D MMMM Y') }} Pukul {{ \Carbon\Carbon::parse($production->updated_at)->isoFormat('HH:mm:ss') }}
                </small> 
            </div>
        </div>
    </div>
</body>
<!-- jQuery -->
<script src="/assets/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/bootstrap-5/bootstrap.min.js') }}"></script>
</html>