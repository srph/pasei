<!DOCTYPE html>
<html>
<head>
  <title>@yield('title') - Pasei Staff Dashboard</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @yield('styles')
</head>
<body>
  <div class="container">
    <nav class="main-nav">
      <div class="main-nav__section">
        <a href="/" class="main-nav__item">Home</a>
        <a href="{{ route('students.index') }}" class="main-nav__item">Students</a>
        <a href="{{ route('teachers.index') }}" class="main-nav__item">Teachers</a>
        <a href="{{ route('subjects.index') }}" class="main-nav__item">Subjects</a>
        <a href="{{ route('classes.index') }}" class="main-nav__item">Classes</a>
      </div>

      <div class="main-nav__section">
        <div class="main-nav__item main-nav__item--non-link">
          Welcome, <strong>Kier</strong>!
        </div>
        
        <a href="#" class="main-nav__item">Logout</a>
      </div>
    </nav>

    @yield('content')
  </div>

  <script src="js/app.js"></script>
  @yield('scripts')
</body>
</html>