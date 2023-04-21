@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Cierre de Tarjeta</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/cajas/tarjeta/edit') }}" enctype="multipart/form-data">
                {{csrf_field() }} 
                <input type="hidden" name="id" value="{{$tarjeta->id}}"> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" id="detalle" name="detalle" 
                        value=" {{ old('detalle',$tarjeta->detalle) }}" requiered>  
                    </div>
                    <div class="form-group col-md-6">
                      <label for="importe">Importe</label>
                      <input type="text" class="form-control" id="importe" name="importe" 
                      value ="{{ old('importe',$tarjeta->importe)}}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="terminal_number">N° de Terminal</label>
                        <input type="text" class="form-control" id="terminal" name="terminal_number" 
                        value=" {{ old('terminal_number',$tarjeta->terminal_number) }}" requiered>  
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lote_number">N° de Lote</label>
                      <input type="number" class="form-control" id="lote" name="lote_number" 
                      value ="{{ old('lote_number',$tarjeta->lote_number)}}" required>
                    </div>
                </div>                 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Actualizar Cierre</button>
                         <a href=" {{ url('/admin/cajas/'.$tarjeta->id.'/egreso')}}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
