<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/490dc00a45.js" crossorigin="anonymous"></script>

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/admins/css/sidebar.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="https://sun-asterisk.vn/wp-content/uploads/2019/03/Sun-Logotype-RGB-01.png">
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-home"></i> Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                        <a href="{{ route('user.index') }}"><i class="fas fa-users"></i> List User</a>
                        </li>
                        <li>
                         <a href="{{ route('my_news.index') }}"><i class="fas fa-newspaper"></i> My News</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle"><i class="far fa-newspaper"></i> News</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-newspaper"></i> List News</a>
                        </li>
                      
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenuTag" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle"><i class="fas fa-user-tag"></i> Tags</a>
                    <ul class="collapse list-unstyled" id="pageSubmenuTag">
                        <li>
                         <a href="{{ route('tags.index') }}"><i class="fas fa-tags"></i>List Tags</a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2>@yield('title','Admin')</h2>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
