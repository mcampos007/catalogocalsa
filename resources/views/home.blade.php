@extends('layouts.app')

@section('title','Bienvenido a Aristaeus Panel de Control')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}' ); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="profile-tabs">
            <div class="nav-align-center">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="#dashboard" role="tab" data-toggle="tab">
                            <i class="material-icons">camera</i>
                            Pedido Actual
                        </a>
                    </li>
                    <li>
                        <a href="#remitos" role="tab" data-toggle="tab">
                            <i class="material-icons">palette</i>
                            Pedidos Realizados
                        </a>
                    </li>

                    <!-- Notifiaciones -->
                    @if (session('notification'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('notification') }}</strong>
                        </div>
                    @endif
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
                                            <td> $ {{ $detail->quantity * $detail->product->price }}</td>
                                            <td class="td-actions">  
                                                <form method="post" action="{{ url('/cart') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE')}}
                                                    <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                                    <a href="/usuario/editaitemdelpedido/{{ $detail->id }}" type="button" rel="tooltip" title="Editar" class="btn btn-info btn-simple btn-xs">
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
                                <p class="h2"> <strong> Importe a Pagar: {{ auth()->user()->cart->total }}</strong>  </p>
                            @endif
                            <div class="text-center">
                                <form method="post" action="{{ url('/order')}}">
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
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Sucursal</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    
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