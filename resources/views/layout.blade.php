<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @stack('stylesheet')
  <style>
    html,body {
      background-color: #fff;
      color: #636b6f;
      font-family: "Nunito", sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      padding-right: 3em;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links > a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }

    .nowrap {
      white-space: nowrap;
    }

    .scroll {
      overflow: scroll;
    }
  </style>
</head>

<body>
  <nav class="navbar mb-4">
    <div class="navbar-brand links">
      <a href=" {{ url('/')}} ">{{ config('app.name', 'yps1 task#6') }}</a>
    </div>
    @if (Route::has('login'))
    <div class="top-right links">
      @auth
        <div class="dropdown">
          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ url('/tasks') }}">タスク管理</a>
            <a class="dropdown-item" href="{{ url('/calendar') }}">カレンダー</a>
            <a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a>
          </div>
        @else
          <a href="{{ route('login') }}">ログイン</a>
          @if (Route::has('register'))
          <a href="{{ route('register') }}">新規登録</a>
          @endif
        @endauth
      </div>
    </div>
    @endif
  </nav>
    <div class="container">
      @if(session('message'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{@session('message')}}
      </div>
      @endif
      @include('error')
      @yield('header')
      @yield('content')
    </div>
  @yield('scripts')
</body>

</html> 