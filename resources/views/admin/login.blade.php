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
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>

<body>
    <div class="d-flex justify-content-center align-content-center" style="height: 100vh; align-items: center;">
        <div class="card" style="width: 350px; height: 300px;">
            <article class="card-body">
                <h4 class="card-title text-center mb-4 mt-1">Admin</h4>
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" class="form-control" placeholder="Email or login" type="email">
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
                        <button type="submit" class="btn btn-primary btn-block"> Login </button>
                    </div>
                </form>
            </article>
        </div> <!-- card.// -->
    </div>

</body>

</html>
