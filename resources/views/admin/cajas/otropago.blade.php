@extends('layouts.app')

@section('title','Listado de Egresos')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Otros Pagos de la Caja N° {{$caja->id}}</h2>
            <div class="card-body">
                @if (session('notification'))
                
                <div class="alert alert-success" role="alert">
                  {{ session('notification')}}
                </div>
                @endif

              </div>
 
            <div class="team">
                @if (session()->has('msj'))
                        <div class="alert alert-danger" role="alert">
                              <strong>Error:!!</strong>{{session('msj')}}
                        </div>
                    @endif
                <div class="row">
                    @if(auth()->user()->role=="admin")
                    <a href="{{ url('/admin/cajas/'.$caja->id.'/otrafpcreate')}}" class="btn btn-primary btn-round">Nuevo Pago</a>
                    <a href="{{ url('/admin/cajas')}}" class="btn btn-primary btn-round">Volver</a>")
                    @else
                    <a href="{{ url('/usuario/cajas/'.$caja->id.'/otrafpcreate')}}" class="btn btn-primary btn-round">Nuevo Pago</a>
                    <a href="{{ url('/usuario/cajas')}}" class="btn btn-primary btn-round">Volver</a>
                    @endif
                    <div class="row justify-content-center">
                        <div class="col-4 h2">
                          Total de Pagos: ${{ $t }}
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Cliente</th>
                                <th class="col-md-2 text-center">Tipo</th>
                                <th class="col-md-2 text-center">Detalle</th>
                                <th class="col-md-2 text-center">Importe</th>
                                <th class="text-right">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($otropagos as $otropago)
                               
                            <tr>
                                <td class="text-center">{{ $otropago->id }}</td>
                                <td>{{ $otropago->client->name }}</td>
                                <td>{{ $otropago->tipomovimiento->name }}
                                <td>{{ $otropago->detalle }}</td>
                                <td>{{ $otropago->importe }}</td>
                                <td class="td-actions text-right">
                                    @if(auth()->user()->role=="admin")
                                    <form method="post" action="{{ url('/admin/cajas/otrafp/'.$otropago->id)}}">
                                    @else
                                    <form method="post" action="{{ url('/usuario/cajas/otrafp/'.$otropago->id)}}">
                                    @endif
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        @if(auth()->user()->role=="admin")
                                        <a href="{{ url('/admin/cajas/otrafp/'.$otropago->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs ">
                                        @else
                                        <a href="{{ url('/usuario/cajas/otrafp/'.$otropago->id.'/edit')}}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs ">
                                        @endif
                                        <i class="bi bi-cash-coin"></i>
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
                    {{ $otropagos->links() }}
                    
                    
                </div>
            </div> 

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
