@extends('layouts.app')

@section('title','Todas nuestras Propuestas')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>
<div class="main main-raised">
    <div class="container">
        <!-- Notifiaciones -->
        @if (session('notification'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('notification') }}</strong>
            </div>
        @endif
        
        <div class="container">
            <h2 class="title">Datos del Pedido N° {{ $remito->id }} Sucursal {{$remito->sucursal->name}}</h2>
        </div>
        <div class="tab-content gallery">
            <form>
                {{-- <div class="form-group">
                    <div class="col-md-6">
                        <label for ="sucursal">Sucursal</label>
                        <select name="sucursal_id" id="sucursal" class="form-control" disabled>
                            @foreach($sucursales as $sucursal)
                            {
                                <option value="{{ $sucursal->id }}"
                                    @if( $sucursal->id == $remito->sucursal_id ) selected @endif>
                                    {{ $sucursal->name }}
                                </option>
                            }
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-md-6">
                        <label for ="pedido_id">Pedido N°</label>
                
                        <input type="text" class="form-control" id="pedido_id" name="remito_id" value="{{ $remito->id }}" disabled>
                    </div>
                </div> --}}
                <!-- Detalle del Remito -->
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Código</th>
                            <th class="text-center">Nombre</th>
                            <th >Precio</th>
                            <th >Cantidad</th>
                            <th >Stk en la Suc</th>
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
                                    {{ $detail->product->nro_art }}
                                </td>
                                <td>
                                    {{ $detail->product->name }}
                                </td>
                                <td >$ {{ $detail->product->price }}</td>
                                <td> 
                                    {{ $detail->quantity }}
                                </td>
                                <td> {{ $detail->stocklocal }}</td>
                                <td> $ {{ $detail->quantity * $detail->product->price }}</td>
                                <td scope="row">
                                    @if ($remito->status == 'Pending')
                                    
                                        <a href="{{ url("/admin/remito/edititem/".$detail->id) }}" type="button"      
                                        rel="tooltip" title="Editar el Item" class="btn btn-info btn-simple btn-xs"> <i class="material-icons">mode_edit</i>    
                                    
                                    @endif
                                </a>
                          </td>
                            
                            </tr
                        @endforeach>
                    </tbody>
                    <!-- Fin detalle del Remito -->
                </table>
                <p> <strong> Importe Total: {{$remito->total }}</strong>  </p>
                <a href=" {{ url('/admin/remito/'.$remito->id .'/remitopdf') }}" class="btn btn-default">Ver Pdf</a>
                @if(auth()->user()->role="Admin")
                    @if ($remito->status =="Pending")
                        <a href=" {{ url('/admin/remito/'.$remito->id .'/facturar') }}" class="btn btn-default">Autorizar y pasar a Facturación</a>            
                    @endif
                @endif
     
                <a href=" {{ url('/home') }}" class="btn btn-default">Volver</a>
            </form>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
