<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password</title>
    <script src="{{ asset('js/app.js') }}"></script>
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
                <div class="col-md-8">
                    <div class="logo-pabi">
                        <img src="http://pabi-membership.rumahsinergikarya.com/assets_member/images/logo.png" width="180" height="40" alt="header-logo">
                    </div>
                    <div class="card">
                        <div class="card-header" style="color: white; background: #00a3c8;">
                            Please Input your password
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ url('reset-password') }}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                    <div class="col-md-6">
                                        <input type="hidden" name="email" value="{{ $param }}">
                                        <input id="password" type="password" class="form-control" name="password" require>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>
                                    <div class="col-md-6">
                                        <input id="confirm_password" type="password" class="form-control" name="confirm_password" require>
                                        <span style="font-size: 10pt;" id="msg"></span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button id="btn" type="submit" class="btn btn-primary" disabled>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#confirm_password').val()) {
                if ($('#confirm_password').val() == $('#password').val()) {
                    $('#msg').html('').css('color', 'red');
                    $('#btn').attr('disabled', false);
                } else 
                    $('#msg').html('Not Matching').css('color', 'red');
                }
            }      
        );
    </script>
</body>
</html>
