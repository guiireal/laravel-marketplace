<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{mix('css/front.css')}}">
    @hasSection('styles')
        @yield('styles')
    @endif
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="#">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        @if(session()->has('cart') && count(session()->get('cart')))
                            <span class="badge badge-danger">
                                {{count(session()->get('cart'))}}
                            </span>
                        @endif
                        <i class="fa fa-2x fa-shopping-cart"> </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>
<script src="{{mix('js/front.js')}}"></script>
@hasSection('scripts')
    @yield('scripts')
@endif
</body>
</html>
