@extends('layouts.app')

@section('title','Listado de Cajas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Listado de Cajas </h2>
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
                <div class="row ">
                    @if(auth()->user()->role=="admin")
                        <a href="{{ url('/admin/cajas/create')}}" class="btn btn-primary btn-round">
                    @else
                        <a href="{{ url('/usuario/cajas/create')}}" class="btn btn-primary btn-round">
                    @endif
                        Nueva Caja</a>
                    <table class="table-responsive table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Fecha</th>
                                <th class="col-md-2 text-left">Punto de Vta.</th>
                                <th class="col-md-2 text-left">Usuario</th>
                                <th class="col-md-2 text-left">Total</th>
                                <th class="col-md-2 text-left">Estado</th>
                                {{-- <th>Imágen</th>
                                 <th class="text-center">Categoria</th>
                                <th >Precio</th> --}}
                                <th class="col-md-2">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                            <tr>
                                <td class="text-center">{{ $caja->id }}</td>
                                <td class="text-center">{{ $caja->fecha }}</td>
                                <td class="text-left">{{ $caja->puntodeventa->name }}</td>
                                <td class="col-md-2 text-left>" >{{ $caja->user->name }}</td>
                                <td>{{ $caja->totalplanilla}}</td>
                                <td>{{ $caja->status}}</td>
                                <td class="td-actions text-right">        
                                    <form method="post" action="{{ url('/admin/cajas/'.$caja->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        @if(auth()->user()->role=="usuario")
                                            @include('admin.cajas.indexusuario')
                                        @else
                                            @include('admin.cajas.indexadmin')
                                        @endif
                                            
                                        
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cajas->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
