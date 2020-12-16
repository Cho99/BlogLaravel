<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | Login</title>

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
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>

<body>
    <ul class="nav justify-content-end mr-5">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Language
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('change-language', ['en']) }}">English</a>
              <a class="dropdown-item" href="{{ route('change-language', ['vi']) }}">VietNamese</a>
            </div>
          </li>
    </ul>
    <div class="d-flex justify-content-center align-content-center" style="height: 100vh; align-items: center;">
        <div class="card" style="width: 350px;">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Admin</h4>
                <hr>
                @if (Session::has('mess'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ trans('labels.warning') }}: </strong> {!! Session::get('mess') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('mess_success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ trans('labels.warning') }}: </strong> {!! Session::get('mess_success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Email or login" type="email"
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" name="password" placeholder="******" type="password">
                        </div>
                        @error('password')
                            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> {{ trans('labels.login') }} </button>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember">{{ trans('labels.remember_me') }}
                    </div>
                    <p class="text-center"><a href="#" class="btn">{{ trans('labels.forgot_password') }} ?</a> OR <a
                            href="{{ route('create') }}" class="btn">{{ trans('labels.register') }}</a> </p>
                </form>
            </article>
        </div> <!-- card.// -->
    </div>

</body>

</html>
