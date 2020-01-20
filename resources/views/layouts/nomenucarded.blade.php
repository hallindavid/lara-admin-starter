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

    @include('layouts.includes.styles')
</head>
<body class="hold-transition layout-top-nav">
    <div id="app" class="wrapper"><!-- Wrapper Opening -->

        @include('layouts.panels.topnav', ['layout'=>'top'])

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @include('layouts.panels.content-header', ['layout'=>'top'])
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 px-4">
                            <div class="card">
                                <div class="card-body">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- end content -->
        </div><!-- End Content-wrapper -->
        @include('layouts.panels.footer')
        @include('layouts.panels.aside')
    </div><!-- #app .wrapper closing -->
<!-- Scripts -->

@include('layouts.includes.scripts')
</body>

</html>
