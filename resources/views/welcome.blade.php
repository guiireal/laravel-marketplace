@extends('layouts.front')

@section('content')
    <div class="row">
        @foreach($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    @if($product->photos()->count())
                        <img src="{{asset("storage/{$product->photos->first()->image}")}}" alt="product" class="card-img-top">
                    @else
                        <img src="{{asset("storage/assets/img/no-photo.jpg")}}" alt="product" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <p class="card-text">{{$product->description}}</p>
                        <h3>{{$product->format_price}}</h3>
                        <a href="{{route('product.show', ['slug' => $product->slug])}}" class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 === 0)
                <div class="row"></div>
            @endif
        @endforeach
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <h2>Lojas Destaque</h2>
            <hr>
        </div>
        @foreach($stores as $store)
            <div class="col-4">
                <img src="{{asset('storage/logo/default_logo.png')}}" alt="Loja sem Logo" class="img-fluid">
                <h3>{{$store->name}}</h3>
                <p>{{$store->description}}</p>
            </div>
        @endforeach
    </div>
@endsection
