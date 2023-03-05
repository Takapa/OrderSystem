<!doctype html>
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
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}">商品一覧</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('item.create') }}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus text-dark icon-sm"></i> 商品登録
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('cart.index', Auth::user()->id) }}" class="nav-link">
                                    <i class="fa-solid fa-cart-shopping"></i> カート <span class="badge {{ $count > 0 ? "bg-success" : "bg-warning" }}">{{ $count }}</span>
                                </a>
                            </li>
                    
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    @can('admin')
                                        <a href="{{ route('admin.index') }}" class="dropdown-item">
                                            <i class="fa-solid fa-user-gear"></i>管理者ページ
                                        </a>
                                    @endcan
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">

                    @if (request()->is('admin/*'))
                        <div class="col-2">
                            <div class="list-group">
                                <a href="{{ route('admin.index') }}" class="list-group-item {{ (request()->is('admin/users') ? 'active' : '') }}">
                                    <i class="fa-solid fa-users"></i>ユーザー
                                </a>
                                <a href="{{ route('admin.suppliers.index') }}" class="list-group-item {{ (request()->is('admin/posts') ? 'active' : '') }}">
                                    <i class="fa-solid fa-building"></i>サプライヤー
                                </a>
                                <a href="{{ route('admin.categories.index') }}" class="list-group-item {{ (request()->is('admin/categories') ? 'active' : '') }}">
                                    <i class="fa-solid fa-tags"></i>カテゴリー
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="col-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
