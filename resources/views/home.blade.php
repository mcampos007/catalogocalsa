@extends('layouts.app')

@section('title','Bienvenido a Aristaeus Panel de Control')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}' ); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <!-- Notifiaciones -->
        @if(session('success'))
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ session('notification') }}</strong>
                </div>
            @endif
        @else
            @if (session('notification'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{ session('notification') }}</strong>
                </div>
            @endif
        @endif
        <div class="profile-tabs">
            <div class="nav-align-center">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="#dashboard" role="tab" data-toggle="tab">
                            <i class="material-icons">camera</i>
                            Pedido Actual
                        </a>
                    </li>
                    <li >
                        <a href="#remitos" role="tab" data-toggle="tab">
                            <i class="material-icons">palette</i>
                            Pedidos Realizados
                        </a>
                    </li>
                </ul> 
                <div class="tab-content gallery">
                    <!-- Panel de Pedido Activo -->
                        <div class="tab-pane active" id="dashboard">
                            <hr>
                             @if (auth()->user()->cart)                       
                                <p>Pedido N° {{ auth()->user()->cart->id }}  y tiene {{ auth()->user()->cart->details->count() }} Items</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th >Precio</th>
                                            <th >Cantidad</th>
                                            <th >% Desc</th>
                                            <th >Sub total</th>
                                            <th >Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( auth()->user()->cart->details as $detail)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ url($detail->product->featured_image_url) }}" height="50">
                                            </td>
                                            <td>
                                                <a href="#" > {{ $detail->product->name }}
                                                {{-- <a href=" {{ url('/products/'.$detail->product->id ) }}" > {{ $detail->product->name }} --}}
                                            </td>
                                            <td >$ {{ $detail->product->price }}</td>
                                            <td> {{ $detail->quantity }}</td>
                                            <td> {{ $detail->discount }}</td>
                                            <td> $ {{ round($detail->Preciocon_Descuento * $detail->quantity,2)}}</td>
                                            <td class="td-actions">  
                                                <form method="post" action="{{ url('/cart') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE')}}
                                                    <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                                    <!-- <a href="/usuario/editaitemdelpedido/{{ $detail->id }}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs"> -->
                                                    <a href=" {{url('/usuario/editaitemdelpedido/'.$detail->id) }}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs">
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
                                <p class="h2"> <strong> Importe a Pagar: {{ round(auth()->user()->cart->total,2) }}</strong>  </p>
                            @endif
                            @if (round(auth()->user()->cart->total,2)!=0)
                            <div class="alert alert-info">
                                <div class="container-fluid">
                                  <div class="alert-icon">
                                    <i class="material-icons">info_outline</i>
                                  </div>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                  </button>
                                  <b>Información:</b> Para Confirmar el pedido, ingrese las observaciones que considere necesarias, seleccione el cliente y presione ENVIAR PEDIDO!!
                                </div>
                            </div>
                            <div class="text-center">
                                <form method="post" action="{{ url('/closeorder')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="pedido_id" value="{{ auth()->user()->cart->id }}">

                                     <div class="row">
                                        <div class="col-md-6">
                                            <textarea class="form-control" placeholder="Ingrese sus Observaciones" rows="3" name="observ"></textarea>
                                        </div>
                                        @if(auth()->user())
                                         <div class="col-md-6 form-group">
                                        {{-- <div class="form-group label-floating"> --}}
                                            <label class="form-group label-floating" >Debe Seleccionar el Cliente.</label>
                                            <select class="form-control" id="inputGroupSelect01" name="cliente_id">
                                                {{-- <option selected>Seleccione el cliente ...</option> --}}
                                                @foreach($clifacs as $clifac)
                                                {
                                                    <option value="{{ $clifac->id }}" >{{ $clifac->cliente }} 
                                                    </option>
                                                }
                                                @endforeach
                                              </select>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row text-center">
                                        <button type="submit" class="btn btn-primary btn-round">
                                            <i class="material-icons">done</i> Enviar Pedido
                                        </button>
                                        <a href=" {{ url('/') }}" class="btn btn-primary btn-round" >
                                            <i class="material-icons">pending</i> Lista de Productos
                                        </a>
                                    </div>
                                </form>
                            </div>
                            @else
                                <div class="row text-center">
                                    <a href=" {{ url('/') }}" class="btn btn-primary btn-round" >
                                        <i class="material-icons">pending</i> Lista de Productos
                                    </a>
                                </div>

                            @endif
                              
                        </div>
                    <!-- Panel de Pedidos -->
                        <div class="tab-pane text-center" id="remitos">
                            <!-- Lista de Remitos  -->
                            <hr>
                             @if (auth()->user()->cart)
                                 <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Vendedor/Usuario</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-left col-md-4">Cliente</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   <tbody> 
                                    @foreach($remitos as $pedido)
                                        <tr>
                                            <td class="text-center">{{$pedido->id}}</td>
                                            <td class="text-center">{{$pedido->order_date}}</td>
                                            <td class="text-center">{{$pedido->user->name}}</td>
                                            <td class="text-center">{{$pedido->status}}</td>
                                            <td class="text-left col-md-4">{{$pedido->client_name}}</td>
                                            <td class="td-actions">  
                                                <form method="post" action="{{ url('/cart') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE')}}
                                                    <input type="hidden" name="cart_detail_id" value="{{ $pedido->id }}">
                                                    <!-- <a href="/usuario/editaitemdelpedido/{{ $pedido->id }}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs"> -->
                                                    @if (auth()->user()->role=="admin")
                                                    <a href=" {{url('/admin/remito/'.$pedido->id) }}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                    </a>
                                                    @endif
                                                    <!-- <a href=" {{url('/admin/remito/'.$pedido->id).'/reabrir' }}" type="button" rel="tooltip" title="Abrir Nuevamente" class="btn btn-info btn-simple btn-xs">
                                                    <span class="material-icons">done</span>
                                                    </a> -->
                                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table> 
                             @endif
                        </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection