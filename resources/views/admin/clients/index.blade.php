@extends('layouts.app')

@section('title','Clientes')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Clientes</h2>

            <div class="team">
                @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('msj')}}
                        </div>
                    @endif
                <div class="row">
                    
                    <a href="{{ url('/admin/clients/create')}}" class="btn btn-primary btn-round">Nuevo Cliente</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Nombre</th>
                                <th class="col-md-4 text-center">Dirección</th>
                                <th class="col-md-4 text-center">E-mail></th>
                                <!-- <th class="text-center">Categoria</th>
                                <th >Precio</th>-->
                                <th class="text-right">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td class="text-center">{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->direccion }}</td>
                                <td>{{ $client->email }}</td>
                                <td class="td-actions text-right">
                                    
                                    <form method="post" action="{{ url('/admin/clients/'.$client->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        <a href="" type="button" rel="tooltip" title="Ver" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-info"></i>
                                        </a>
                                        <a href=" {{ url('/admin/clients/'.$client->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
                                        <i class="fa fa-edit"></i>
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
                    {{ $clients->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
