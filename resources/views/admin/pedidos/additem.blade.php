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
                </ul> 
                <div class="tab-content gallery">
                    <hr>                       
                        <p>Pedido N° {{ $cart->id }}  y tiene {{ $cart->details->count() }} Items</p>
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
                                @foreach( $cart->details as $detail)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ url($detail->product->featured_image_url) }}" height="50">
                                    </td>
                                    <td>
                                        <a href="#" > {{ $detail->product->name }}
                                        {{-- <a href=" {{ url('/products/'.$detail->product->id ) }}" > {{ $detail->product->name }} --}}
                                    </td>
                                    <td >$ {{ $detail->price }}</td>
                                    <td> {{ $detail->quantity }}</td>
                                    <td> {{  0 }}</td>
                                    <td> $ {{ round($detail->price * $detail->quantity,2)}}</td>
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
                        <p class="h2"> <strong> Importe a Pagar: {{ round($cart->total,2) }}</strong>  </p>
                        <div class="row text-center">
                            <a href=" {{ url('/orders/'.$cart->id.'/additem') }}" class="btn btn-primary btn-round" >
                                <i class="material-icons">pending</i> Agregar Articulos al Pedido
                            </a>
                        </div>

                </div>
                
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection