@extends('layouts.app')

@section('title','Facturación de Remito')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}');background-size: cover; background-position: top center;">
</div>
<div class="main main-raised">
    <div class="container">
    <h1>Autorización del Pedido N° {{ $remito->id }}</h1>
        <form method="post" action="{{ url('/admin/remito/facturar') }}">
            {{ csrf_field() }}
            <input type="hidden" name="remito_id" value="{{$remito->id }}">
            <!-- Detalle del Remito -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th >Precio</th>
                        <th >Cantidad</th>
                        <th >Sub total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remito->details as $detail)
                        <tr>
                            <td>
                                {{ $detail->id }}
                            </td>
                            <td>
                                {{ $detail->product->name }}
                            </td>
                            <td >$ {{ $detail->product->price }}</td>
                            <td> {{ $detail->quantity }}</td>
                            <td> $ {{ $detail->quantity * $detail->product->price }}</td>
                        
                        </tr
                    @endforeach>
                </tbody>
                <!-- Fin detalle del Remito -->
            </table>
            <p> <strong> Importe Total: {{$remito->total }} , Total Items: {{$remito->totalitems}}</strong>  </p>
            <button type="submit" class="btn btn-primary btn-round">
                    <i class="material-icons">done</i> Confirmar Pedido
            </button>
            
            <a href=" {{ url('/home') }}" class="btn btn-default">Volver</a>
        </form>
    </div>
</div>
@include('includes.footer')
@endsection
