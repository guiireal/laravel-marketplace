@extends('layouts.app')

@section('content')
    <a href="{{route('admin.products.create')}}"
       class="btn btn-lg btn-success">
        Criar Produto
    </a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->formatPrice}}</td>
                <td>{{$product->store->name ?? ''}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.products.edit', ['product' => $product->id])}}"
                           class="btn btn-sm btn-primary mr-2">
                            EDITAR
                        </a>
                        <form onclick="if(!confirm('Deseja realmente excluir o produto selecionado?')){return false;}" action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">REMOVER</button>
                        </form>
                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection
