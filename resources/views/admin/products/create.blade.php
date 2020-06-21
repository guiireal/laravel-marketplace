@extends('layouts.app')

@section('content')
    <h1>Criar Produto</h1>
    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome Produto</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input class="form-control" type="text" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="body">Conteúdo</label>
            <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categorias</label>
            <select class="form-control" name="categories[]" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="photos">Fotos do Produto</label>
            <input type="file" id="photos" name="photos[]" class="form-control" multiple>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" id="slug" name="slug">
        </div>
        <div class="form-group">
            <label for="price">Preço</label>
            <input class="form-control" type="text" id="price" name="price">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-success" type="submit">Criar Produto</button>
        </div>
    </form>
@endsection
