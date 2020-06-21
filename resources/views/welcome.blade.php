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
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
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
@endsection
