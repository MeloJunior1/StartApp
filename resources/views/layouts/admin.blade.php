<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Core - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/metisMenu/dist/metisMenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/animate.css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" />
    <link rel="stylesheet" href="{{ asset('/fonts/pe-icon-7-stroke/css/helper.css') }}" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/style.css') }}" />

    <!-- Para qualquer estilo especial -->
    @yield('styles')

</head>
<body class="fixed-navbar sidebar-scroll">

    <!-- Header -->
    <div id="header">
        <div class="color-line"></div>
        <div id="logo" class="light-version">
            <span>
                Core App - V1
            </span>
        </div>
        <nav role="navigation">
            <div class="header-link hide-menu">
                <i class="fa fa-bars"></i>
            </div>
            <div class="small-logo">
                <span class="text-primary">CORE APP V1</span>
            </div>
            <form role="search" class="navbar-form-custom" method="post" action="#">
                <div class="form-group">
                    <input type="text" placeholder="Procure por algo ..." class="form-control" name="search">
                </div>
            </form>
            <div class="mobile-menu">
                <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="collapse mobile-navbar" id="mobile-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="" href="login.html">Configurações</a>
                        </li>
                        <li>
                            <a class="" href="login.html">Perfil</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                Logout

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="pe-7s-config"></i>
                        </a>

                        <ul class="dropdown-menu hdropdown notification animated flipInX">
                            <li>
                                <a>
                                    <span>Configurações</span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <span>Perfil</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="pe-7s-upload pe-rotate-90"></i>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Navigation -->
    <aside id="menu">
        <div id="navigation">
            <div class="profile-picture">
                <a href="index.html">
                    <img src="{{ asset('/vendor/images/user.png') }}" width="76" class="img-circle m-b" alt="logo">
                </a>

                <div class="stats-label text-color">
                    <span class="font-extra-bold font-uppercase">
                        {{ Auth::user()->name }}
                    </span>
    
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <small class="text-muted">
                                {{ Auth::user()->companyName }} 
                            </small>
                        </a>
                    </div>
                </div>
            </div>

            <ul class="nav" id="side-menu">
                <li class="active">
                    <a href="/admin">
                        <span class="nav-label">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="nav-label">Restaurantes</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('rest.add') }}" class="new-link">
                                Novo
                                <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            </a>
                        </li>
                        
                        @foreach(\Restaurant::findRestaurants() as $restaurant)
                            <li>
                                <a href="{{ route('rest.get', $restaurant->id) }}">
                                    {{ $restaurant->nome }}
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div id="wrapper">
        @yield('content')
    </div>


    <script src=" {{ asset('/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src=" {{ asset('/vendor/jquery-slimscroll/jquery.slimscroll.min.js ') }}"></script>
    <script src=" {{ asset('/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src=" {{ asset('/vendor/metisMenu/dist/metisMenu.min.js') }}"></script>
    <script src=" {{ asset('/vendor/scripts/homer.js') }}"></script>
    <!-- Para qualquer script especial -->
    @yield('scripts')
</body>
</html>