<!doctype html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Глемпинг</title>
    <link rel="stylesheet" href="{{asset('/css/fonts.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.1/css/all.css">

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>



    <script src="{{asset('/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


<!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">


    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">



    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.css')}}">
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <!-- Bootstrap Color Picker -->



    <!-- overlayScrollbars -->
        <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.js')}}"></script>
        <!-- dropzonejs -->
        <script src="{{asset('/plugins/dropzone/min/dropzone.min.js')}}"></script>
        <!-- Theme styles -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

        <!-- CodeMirror -->
        <link rel="stylesheet" href="{{asset('plugins/codemirror/codemirror.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/codemirror/theme/monokai.css')}}">
        <!-- CodeMirror -->
        <script src="{{asset('plugins/codemirror/codemirror.js')}}"></script>
        <script src="{{asset('plugins/codemirror/mode/css/css.js')}}"></script>
        <script src="{{asset('plugins/codemirror/mode/xml/xml.js')}}"></script>
        <script src="{{asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script src="https://unpkg.com/vue3-sortablejs/dist/vue3-sortablejs.global.js"></script>

        <!-- Summernote -->
        <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

        <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">



<!-- Select2 -->

    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>



    <link rel="stylesheet" href="{{asset('/css/evol-colorpicker.css')}}">
    <script src="{{asset('/js/evol-colorpicker.min.js')}}"></script>
    @vite(['resources/js/app-lte.js','resources/css/app.css'])
    <script>
        let settingsSite = @json($settings);

    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper" id="app"></div>


</body>

</html>





