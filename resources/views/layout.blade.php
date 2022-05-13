

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
        @yield('styles')

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Route Library </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active" aria-current="page" href=" {{ route('books.index')}}">Books</a>
                  <a class="nav-link" href=" {{ route('categories.index')}}">Categories</a>
                  @guest
                    <a class="nav-link" href="{{ route('auth.register') }}">Register</a>
                    <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                  @endguest
                  @auth
                    <a class="nav-link" href="{{ route('auth.logout') }}">LogOut</a>
                    <a class="nav-link" href="#" disapled> {{ Auth::user()->name }}</a>
                  @endauth

                </div>
              </div>
            </div>
        </nav>

        <div class="container py-5"> <!-- py-5 meaning that padding from top and bottom 5px-->
            @yield('Content')
        </div>


        <script src="{{ asset('js/jquery-3.6.0.js')}}"></script>
        <script src="{{ asset('js/bootstrap.js')}}"></script>
        @yield('scripts')

    </body>
</html>
