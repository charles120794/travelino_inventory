<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="">

    <title> @yield('title') </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('custom/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/fonts/admin_google_fonts.css') }}">

</head>

<body>
    
    @yield('content')

    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('contextmenu', event => event.preventDefault());
        $(document).ready(function(){
            window.print();
            console.log(window)
        });
    </script>

</body>
</html>
    