@extends('layouts.app')

@section('content')
    <h1>{{$store->name}}</h1>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-grou´p">
            <label for="name">Nome Loja</label>
            <input class="form-control" type="text" id="name" name="name" value="{{$store->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input class="form-control" type="text" id="description" name="description" value="{{$store->description}}">
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input class="form-control" type="text" id="phone" name="phone" value="{{$store->phone}}">
        </div>
        <div class="form-group">
            <label for="mobile-phone">Celular / Whatsapp</label>
            <input class="form-control" type="text" id="mobile-phone" name="mobile_phone" value="{{$store->mobile_phone}}">
        </div>
        <div class="form-group">
            <p>
                <img src="{{asset("storage/{$store->logo}")}}" alt="logo">
            </p>
            <label for="photos">Fotos do Produto</label>
            <input type="file" id="photos" name="photos[]" class="form-control" multiple>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" id="slug" name="slug" value="{{$store->slug}}">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary" type="submit">Atualizar Loja</button>
        </div>
    </form>
@endsection
