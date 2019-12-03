<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->
    @if(Auth::user())
        @if(Auth::user()->is_admin)
            <script>
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                    'api_token' => 'Bearer ' . Auth::user()->api_token,
                    'is_admin'=>1,
                ]) !!};
            </script>
        @else
            <script>
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                    'api_token' => 'Bearer ' . Auth::user()->api_token,
                ]) !!};
            </script>
        @endif
  @else
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  @endif


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- Font Awesome -->
    <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app" class="wrapper"><!-- Wrapper Opening -->

        @include('layouts.panels.topnav')
        @include('layouts.panels.sidemenu')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.panels.content-header')
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section><!-- end content -->
        </div><!-- End Content-wrapper -->
        @include('layouts.panels.footer')
        @include('layouts.panels.aside')
    </div><!-- #app .wrapper closing -->
<!-- Scripts -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ mix('js/adminlte.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
