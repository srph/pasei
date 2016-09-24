<!DOCTYPE html>
<html>
<head>
  <title>Login - Pasei Grading System</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @yield('styles')
</head>
<body>
  <div class="vtc-container">
  <div class="container">
    <div class="u-size-5 u-block-center">
        <h1 class="u-text-center u-text-light">
          Pasei Login
        </h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" class="form-input" value="{{ old('email') }}">
            @include('error', ['error' => 'email'])
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="*********" class="form-input">
            @include('error', ['error' => 'password'])
          </div>

          <button class="btn btn--primary btn--block">
            Login
          </button>
        </form>
    </div>
  </div>
  </div>

  <script src="https://use.fontawesome.com/c808533dc5.js" async></script>
  <script src="js/app.js"></script>
  @yield('scripts')
</body>
</html>