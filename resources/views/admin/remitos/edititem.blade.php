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
            <h2 class="title">Datos del Pedido N° {{ $cartDetail->cart_id }} </h2>
        </div>
        <div class="tab-content gallery">
            <form method="post" action=" {{ url('/admin/remito/item') }}" >
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $cartDetail->id}}">
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="name">Descripción</label>
                            <input type="text" value="{{ $cartDetail->product->name  }} " placeholder="" class="form-control" name="name" disabled />
                        </div>
                    </div>
                    

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="nro_art">Código</label>
                            <input type="text" value="{{  $cartDetail->product->nro_art }} " placeholder="" class="form-control" disabled name="nro_art" disabled />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="id" value="{{ $cartDetail->id }}" placeholder="Id" class="form-control" disabled name="id"/>
                        </div>
                    </div>
                    

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="quantity">Cantidad Pedida</label>
                            <input type="text" value="{{ $cartDetail->quantity  }} " placeholder="" class="form-control" name="quantity"  />
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="stocklocal">Stock Local</label>
                            <input type="text" value="{{ $cartDetail->stocklocal  }} " placeholder="" class="form-control" name="stocklocal"  />
                        </div>
                    </div>            
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <input type="submit"  class="btn btn-success" value="Actualizar">
                        <a href=" {{ url('/home') }}" class="btn btn-default">Volver</a>
                    </div>
                </div>

                
            </form>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
