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
    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p>
                <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via
                    facebook</a>
            </p>
            <p class="divider-text text-center">
                <span class="bg-light">OR</span>
            </p>
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="author" class="form-control" placeholder="Full name" type="text">

                </div> <!-- form-group// -->
                @error('author')
                    <span class="text-danger mt-2">{{ $message }}</span>
                @enderror
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email address" type="email">

                </div>
                @error('email')
                    <span class="text-danger  mt-2">{{ $message }}</span>
                @enderror

                <!-- form-group// -->
                {{-- <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <input name="" class="form-control" placeholder="Phone number" type="text">
                </div> <!-- form-group// --> --}}
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="password" placeholder="Create password" type="password">

                </div> <!-- form-group// -->
                @error('password')
                    <span class="text-danger  mt-2">{{ $message }}</span>
                @enderror
                {{-- <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="re_password" placeholder="Repeat password" type="password">
                </div> <!-- form-group// --> --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="{{ route('admin.login') }}">Log In</a> </p>
            </form>
        </article>
    </div> <!-- card.// -->

</body>

</html>
