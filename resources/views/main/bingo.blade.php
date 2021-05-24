<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Bingo Yeah!! </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icon -->
    <link href="" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">

    @stack('styles')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>

<body>

@yield('content')
<!-- jQuery 3 -->
<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<script type="text/javascript">
    $(function(){
        $('#btn-toggle-navbar').click(function(){
            $('#toggle-navbar').slideToggle();
        });
    });
</script>

@stack('scripts')

</body>

</html>