<!-- DESIGN AND DEVELOPMENT BY ROMADHAN EDY P - SMKN 10 JAKARTA -->
<!-- GITHUB.COM/DYPRAST -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/bpbd.png') }}">
    <title>Login - Bantuan BPBD</title>
    <link rel="stylesheet" href="{{ asset('authAssets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authAssets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authAssets/vendor/animate/animate.css') }}">  
    <link rel="stylesheet" href="{{ asset('authAssets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" href="{{ asset('authAssets/vendor/select2/select2.min.css') }}">
    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('authAssets/css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('authAssets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="background-img">
                <img src="{{ asset('assets/images/background/dotted-map-black-small.png') }}">
            </div>
            <div class="wrap-login100 p-l-40 p-r-40 p-t-30 p-b-40">
                <form method="POST" class="login100-form validate-form" action="{{ route('login') }}">
                    @csrf
                    <div style="text-align: center;width: 100%;"><img src="{{ asset('assets/images/bpbd.png') }}" style="width: 50px;"></div>
                    <span class="login100-form-title p-b-15 p-t-15 m-b-20">
                        Bantuan BPBD
                    </span>
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-envelope"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>

                    @if ($errors->has('email') || $errors->has('password'))
                        <script>
                            toastr.error('E-mail Password salah!', 'Gagal Login!');
                        </script>
                    @endif
                    
                    <div class="container-login100-form-btn p-t-25">
                        <button class="login100-form-btn waves-effect">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('authAssets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('authAssets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('authAssets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('authAssets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('authAssets/js/main.js') }}"></script>
</body>
</html>
<!-- DESIGN AND DEVELOPMENT BY ROMADHAN EDY P - SMKN 10 JAKARTA -->
<!-- GITHUB.COM/DYPRAST -->