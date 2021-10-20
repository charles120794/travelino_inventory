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
        <!-- Datables -->
        @stack('datatable-css')
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">

        <link rel="stylesheet" href="{{ asset('custom/styles.css') }}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{-- asset('admin/bower_components/morris.js/morris.css') --}}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{-- asset('admin/bower_components/jvectormap/jquery-jvectormap.css') --}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{-- asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') --}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{-- asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') --}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{-- asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') --}}">

        <script> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?> </script>
        
        @yield('styles')

        @stack('styles')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="{{ asset('admin/fonts/admin_google_fonts.css') }}">

        <link rel="stylesheet" href="{{ asset('dataTables/datatables.min.css') }}"/>
 
    </head>

    <body class="hold-transition skin-blue sidebar-mini">

        <style type="text/css">
            .info-input {  
                display: none; 
            }
            .font-12 {
                font-size: 12px;
            }
            .bg-white {
                background-color: white !important;
            }
            .custom-loader {
                border: 8px solid #f3f3f3;
                border-radius: 50%;
                border-top: 8px solid #3498db;
                width: 45px;
                height: 45px;
                -webkit-animation: spin 2s linear infinite; /* Safari */
                animation: spin 2s linear infinite;
            }
            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Manage > System > Accounts > * */
            .sel-image-class
            {
                height: 150px;
                width: 100%; 
            }

            @media only screen and (max-width: 770px) {
                .sel-image-class
                {
                    height: auto;
                    width: 100%;  
                }
            } 

        </style>

        @stack('facebook')

        <div class="wrapper">

            @include('layouts.topbar')

            @include('layouts.sidebar')
            
            <div class="content-wrapper">
               
                @yield('content')

            </div>

            @include('layouts.footer')

            @include('layouts.asidebar')
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        @stack('datatable-script')
        <!-- Morris.js charts -->
        <script src="{{-- asset('admin/bower_components/raphael/raphael.min.js') --}}"></script>
        <script src="{{-- asset('admin/bower_components/morris.js/morris.min.js') --}}"></script>
        <!-- Sparkline -->
        <script src="{{-- asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') --}}"></script>
        <!-- jvectormap -->
        <script src="{{-- asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') --}}"></script>
        <script src="{{-- asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') --}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{-- asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') --}}"></script>
        <!-- daterangepicker -->
        <script src="{{-- asset('admin/bower_components/moment/min/moment.min.js') --}}"></script>
        <script src="{{-- asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') --}}"></script>
        <!-- datepicker -->
        <script src="{{-- asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') --}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <!--<script src=" asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') "></script>-->
        <script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('custom/custom-js.js') }}"></script>
        
        <script src="{{ asset('custom/pro-group-loader.js') }}"></script>

        <script src="{{ asset('dataTables/datatables.min.js') }}"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{-- asset('admin/dist/js/pages/dashboard.js') --}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{-- asset('admin/dist/js/demo.js') --}}"></script>

        <script src="{{-- asset('js/app.js') --}}"></script>

        <script type="text/javascript">

            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('[data-toggle="tooltip"]').tooltip();
            });

            function copytoclipboard(id) {
                var copyText = document.getElementById(id);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                alert("Copied the text: " + copyText.value);
            }

            function number(id) {
                $('#' + id).val(function(){
                    if(this.value.match(/^[A-Za-z]+$/)) {
                            if($.trim(this.value) == "") {
                                // return this.value;
                            }
                        } else {
                            return this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\./g, '$1');
                    }
                });
            }
            
        </script>

        @yield('scripts')

        @stack('scripts')

    </body>
</html>