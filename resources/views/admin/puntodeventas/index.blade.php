@extends('layouts.app')

@section('title','Puntos de Ventas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Puntos de Ventas</h2>

            <div class="team">
                @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('msj')}}
                        </div>
                    @endif
                <div class="row">
                    
                    <a href="{{ url('/admin/puntodeventa/create')}}" class="btn btn-primary btn-round">Nuevo Punto de Venta</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-4 text-center">Nombre</th>
                                <th class="text-right">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($puntodeventas as $puntodeventa)
                            <tr>
                                <td class="text-center">{{ $puntodeventa->id }}</td>
                                <td>{{ $puntodeventa->name }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/puntodeventa/'.$puntodeventa->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        <a href=" {{ url('/admin/puntodeventa/'.$puntodeventa->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-success btn-simple btn-xs">
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
                    {{ $puntodeventas->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
