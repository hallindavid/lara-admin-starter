@php
    $containerclass="-fluid";
    if ($layout == 'top')
    {
        $containerclass="";
    }
@endphp

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container{{ $containerclass }}">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title-icon') @yield('title') </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

            @if(@isset($breadcrumbs))
                <ol class="breadcrumb float-sm-right">
                    {{-- this will load breadcrumbs dynamically from controller --}}
                    @foreach ($breadcrumbs as $breadcrumb)
                            @if(isset($breadcrumb['link']))
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                            @else
                            <li class="breadcrumb-item active">
                                {{$breadcrumb['name']}}
                            </li>
                            @endif
                        </li>
                    @endforeach
                </ol>
            @endisset
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
