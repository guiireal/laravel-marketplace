<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-5">
            <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name', 'Marketplace') }}</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                @auth
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item {{ (request()->is('admin/stores') ? 'active' : '') }}">
                        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas</a>
                    </li>
                    <li class="nav-item {{ (request()->is('admin/products') ? 'active' : '') }}">
                        <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                    </li>
                    <li class="nav-item {{ (request()->is('admin/categories') ? 'active' : '') }}">
                        <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                    </li>
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                            <form action="{{route('logout')}}" class="logout d-none" method="POST">
                                @csrf
                            </form>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{auth()->user()->name}}</span>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
    </div>
    <script src="{{ mix('js/front.js') }}"></script>
</body>
</html>
