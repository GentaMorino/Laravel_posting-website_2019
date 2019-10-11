<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
​
    <!-- CSRF Token -->
    {{-- https://readouble.com/laravel/5.4/ja/csrf.html --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
​
    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
​
    <!--JQuery-->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
​
    <title>@yield('title')</title>
  </head>
  <body style="padding-top: 50px; padding-bottom:50px;">
    <header>
      @include('layouts.headr')
    </header>
    <main>
      @yield('content')
    </main>
    <footer>
      @include('layouts.footer')
    </footer>
  </body>
</html>