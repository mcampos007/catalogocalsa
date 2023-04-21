@extends('layouts.app')

@section('title','Todas nuestras Propuestas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Productos</h2>

            <div class="team">
                @if (session()->has('msj'))
                    <div class="alert alert-danger" role="alert">
                          <strong>Error:!!</strong>{{session('msj')}}
                    </div>
                @endif
                <div class="row">
                    <a href="{{ url('/admin/products/create')}}" class="btn btn-primary btn-round">Nuevo Producto</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Código</th>
                                <th class="col-md-2 text-center">Nombre</th>
                                <th class="col-md-5 text-center">Descripcion</th>
                                <th class="text-center">Categoria</th>
                                <th >Precio</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td>{{ $product->nro_art }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td class="text-right">$ {{ $product->price }}</td>
                                <td class="td-actions text-right">
                                    
                                    <form method="post" action="{{ url('/admin/products/'.$product->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        <a href="{{ url('/products/'.$product->id)}}" type="button" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs" target="_blank">
                                        <i class="fa fa-info"></i>
                                        </a>
                                        <a href=" {{ url('/admin/products/'.$product->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
                                        </a>
                                        <a href=" {{ url('/admin/products/'.$product->id.'/images')}}" type="button" rel="tooltip" title="Imagenes" class="btn btn-warning btn-simple btn-xs">
                                        <i class="fa fa-image"></i>
                                        </a>
                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $products->links() }}    
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
