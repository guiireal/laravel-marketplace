@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-4">
            @if($product->photos()->count())
                <img src="{{asset("storage/{$product->photos->first()->image}")}}" alt="product" class="card-img-top">
                <div class="row" style="margin-top: 20px">
                    @foreach($product->photos()->get() as $photo)
                        <div class="col-4">
                            <img src="{{asset("storage/{$photo->image}")}}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{asset("storage/assets/img/no-photo.jpg")}}" alt="product" class="card-img-top">
            @endif
        </div>
        <div class="col-8">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>
                <p>{{$product->description}}</p>
                <h3>{{$product->format_price}}</h3>
                <span>Loja: {{$product->store->name}}</span>
            </div>
            <div class="product-add col-md-12">
                <hr>
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div class="form-group">
                        <label for="qty">Quantidade</label>
                        <input type="number" id="qty" name="product[qty]" class="form-control col-md-2" value="1" min="1"
                               max="99"/>
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">{{$product->body}}</div>
@endsection
