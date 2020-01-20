@php
    $menu = array();
    
    $menu[] = (object)[
        'heading'=>true,
        'name'=>'User Settings'];
    $menu[] = (object)[
        'url'=>'/',
        'name'=>'Dashboard',
        'path'=>'/',
        'icon'=>'fas fa-tachometer-alt'
    ];

    if (Gate::allows('org-admin')) {
        
        $menu[] = (object) [
                    'heading'=>true,
                    'name'=> Auth::user()->current_org_name() . ' Settings'];
        $menu[] = (object) [
            'url'=>route('org_admin.users.index'),
            'name'=>'Users',
            'icon'=>'fas fa-users',
            'path'=>'org/employees',
        ];

        
    }


    if (Gate::allows('admin')) {
        $menu[] = (object) [
                    'heading'=>true,
                    'name'=> 'System Administration'];

        $menu[] = (object) [
                    'url'=>route('admin.users'),
                    'path'=>'admin/users',
                    'name'=>'User Management',
                    'icon'=>'fas fa-users-cog'];
        $menu[] = (object) [
                    'url'=>route('admin.organizations'),
                    'name'=>'Org Management',
                    'path'=>'admin/organizations',
                    'icon'=>'fas fa-sitemap']; 
        $menu[] = (object) [
                    'url'=>route('admin.system'),
                    'path'=>'admin/system',
                    'name'=>'System Management',
                    'icon'=>'fas fa-cogs'];
    }
    // Sample tree dropdown
    // $menu[] = (object) [
    //     'url'=>'',
    //     'name'=>'Multi-Level',
    //     'icon'=>'far fa-circle',
    //     'open_if_request'=>'test-1',
    //     'submenu'=>[
    //         (object) [
    //             'url'=>'test-1',
    //             'name'=>'Test 1',
    //             'icon'=>'far fa-circle'
    //         ],
    //         (object) [
    //             'url'=>'test-2',
    //             'name'=>'Test 2',
    //             'icon'=>'far fa-circle'
    //         ]
    //     ]
    // ];
@endphp


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
<!-- Brand Logo -->
<a href="/" class="brand-link logo-switch">
    <img src="{{ asset('images/icon.png') }}" alt="Logo" class="brand-image-xl logo-xs">
    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="brand-image-xs logo-xl">
</a>

<!-- Sidebar -->
<div class="sidebar">
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

        @foreach($menu as $item)
            @if(isset($item->heading) && $item->heading) 
            <li class="nav-header">{{ $item->name }}</li>
            @else
                @php
                    $submenu = false;
                    $open = false;
                    $show = true;
                    if (isset($item->submenu)){
                        $submenu = true;
                        if (request()->is($item->path)) {
                            $open = true;
                        }
                    }
                @endphp
            
            <li class="nav-item {{ ($submenu ? 'has-treeview' : '') }} {{ $open ? 'menu-open' : '' }} ">
                <a href="{{ $item->url }}" class="nav-link {{ (request()->is($item->url) ? 'active' : '') }}">
                    <i class="nav-icon {{ $item->icon }}"></i>
                    <p>{{ $item->name }}
                    @if($submenu)
                        <i class="right fas fa-angle-left"></i>
                    @endif
                    </p>
                </a>

                @if($submenu)
                    <ul class="nav nav-treeview">
                        @foreach($item->submenu as $sub)
                        <li class="nav-item">
                            <a href="{{ $sub->url }}" class="nav-link {{ (request()->is($sub->path) ? 'active' : '') }}">
                                <i class="{{ $sub->icon }} nav-icon"></i>
                            <p>{{ $sub->name }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endif
        @endforeach

    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
