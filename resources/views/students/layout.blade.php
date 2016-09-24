<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') - Pasei Grading System</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @yield('styles')
</head>
<body>
  <div class="container">
    <nav class="main-nav">
      <div class="main-nav__section">
        <a href="/" class="main-nav__item">Home</a>
      </div>

      <div class="main-nav__section">
        <div class="main-nav__item main-nav__item--non-link">
          Welcome,&nbsp;<strong>{{ Auth::user()->full_name }}</strong>!
        </div>

        <a href="{{ route('me.settings') }}" class="main-nav__item @active('me', 'main-nav__item--active')">Account</a>

        <a href="{{ route('logout') }}" class="main-nav__item">Logout</a>
      </div>
    </nav>

    @yield('content')

    <div class="footer">
      &copy; 2016 Pasei Grading System. All rights reserved.
    </div>
  </div>

  <script src="https://use.fontawesome.com/c808533dc5.js" async></script>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
</body>
</html>