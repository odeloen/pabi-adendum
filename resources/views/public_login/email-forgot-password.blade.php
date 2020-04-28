<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Email Send Forgot Password</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
        .logo-pabi {
            text-align: center;
            margin-bottom: 15px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
        <div class="container">
            @include('sweet::alert')
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="logo-pabi">
                        <img src="http://pabi-membership.rumahsinergikarya.com/assets_member/images/logo.png" width="180" height="40" alt="header-logo">
                    </div>
                    <div class="card">
                        <div class="card-header" style="color: white; background: #00a3c8;">
                            Please Input your email
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ url('begin-forgot-password') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Email</label>
                                    <div class="col-md-6">
                                        <input id="password" type="email" class="form-control" name="email" require>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>
