<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('author-dashboard')}}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('author-posts')}}">Posts</a>
      </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">| {{Auth::user()->firstName}} {{Auth::user()->lastName}} |</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('author-logout')}}">Logout</a>
      </li>
    </ul>
  </div>
</nav>

@yield('content')
@yield('scripts')
</body>
</html>