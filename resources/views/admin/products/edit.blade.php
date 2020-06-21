@extends('layouts.app')

@section('content')
    <h1>{{$product->name}}</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome Produto</label>
            <input class="form-control" type="text" id="name" name="name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <input class="form-control" type="text" id="description" name="description"
                   value="{{$product->description}}">
        </div>
        <div class="form-group">
            <label for="body">Conteúdo</label>
            <textarea name="body" id="body" class="form-control" cols="30" rows="10">{{$product->body}}</textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categorias</label>
            <select class="form-control" name="categories[]" id="categories" multiple>
                @foreach($categories as $category)
                    <option
                        value="{{$category->id}}"
                        {{($product->categories->contains($category) ? 'selected' : '')}}
                    >
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="photos">Fotos do Produto</label>
            <input type="file" id="photos" name="photos[]" class="form-control" multiple>
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input class="form-control" type="text" id="slug" name="slug" value="{{$product->slug}}">
        </div>
        <div class="form-group">
            <label for="price">Preço</label>
            <input class="form-control" type="text" id="price" name="price" value="{{$product->price}}">
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-success" type="submit">Atualizar Produto</button>
        </div>
    </form>
    <hr>
    <div class="row">
        @foreach($product->photos as $photo)
            <div class="col-4">
                <img src="{{asset("storage/{$photo->image}")}}" alt="product-photo" class="img-fluid">
                <form action="{{route('admin.photo.remove', ['productPhoto' => $photo->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-danger">
                        REMOVER
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
