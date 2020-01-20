<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @if($layout=='top')
    <a href="/" class="navbar-brand"><img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="brand-image"></a>
    @endif
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        @if($layout=='side')
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth()
        <!-- Power Menu Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @php
                    $me = Auth::user();
                    $heading = $me->first_name;

                    if ($me->current_organization != null)
                    {
                        $heading .= ' - ' . $me->current_org->name;
                    }
                @endphp

                <span class="dropdown-item dropdown-header">{{ $heading }} </span>
                <a href="{{ route('update_preferences') }}" class="dropdown-item">
                    <i class="fas fa-tools mr-2"></i> Preferences
                </a>
                <a href="{{ route('change_password') }}" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('change_org') }}" class="dropdown-item">
                    <i class="fas fa-sitemap"></i> Change Organization
                  </a>
                  <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            </div>

        </li>
        @endauth
    </ul>
</nav>
<!-- /.navbar -->
