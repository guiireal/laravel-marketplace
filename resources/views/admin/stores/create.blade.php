@extends('layouts.app')

@section('content')
    <h1>Criar Loja</h1>
    <form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-grou´p">
            <label for="name">Nome Loja</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
                   value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input class="form-control @error('description') is-invalid @enderror" type="text" id="description"
                   name="description" value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone"
                   value="{{old('phone')}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="mobile-phone">Celular / Whatsapp</label>
            <input class="form-control @error('mobile_phone') is-invalid @enderror" type="text" id="mobile-phone"
                   name="mobile_phone" value="{{old('mobile_phone')}}">
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="photos">Logo</label>
            <input type="file" id="logo" name="logo[]" class="form-control">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" id="slug" name="slug">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-success" type="submit">Criar Loja</button>
        </div>
    </form>
@endsection
