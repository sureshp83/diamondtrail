<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}" />

    <title> AdminLTE 2 with Laravel - @yield('htmlheader_title', 'Admin') </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/fontawesome-all.css')}}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/adminstyle.css') }}" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link href="{{asset('css/bootstrap-slider.css')}}" type="text/css" rel="stylesheet">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('/admin/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    
    <!-- jQuery 3 -->
    <script src="{{ asset('/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('/js/bootstrap-slider.js')}}" type="application/javascript" rel="script"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/admin/plugins/iCheck/icheck.min.js')}}"></script>

    <script src="{{asset('/js/custom_jquery.js')}}"></script>
    <script src="{{asset('/js/jquery.validate.min.js')}}"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ppkhv4kclhwhyl7x1ot889d9er502ryir5ell5br4x6fdz7i"></script>
    <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
