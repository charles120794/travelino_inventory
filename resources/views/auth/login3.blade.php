<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Probuilder | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="/"><b>FINMATEK</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post"> @csrf
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                        @error('email')
                        <span class="glyphicon glyphicon-envelope form-control-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                        @error('password')
                        <span class="glyphicon glyphicon-lock form-control-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div>
                <!-- /.social-auth-links -->
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
                @endif
                <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <!-- jQuery 3 -->
        <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
        </script>
    </body>
</html>