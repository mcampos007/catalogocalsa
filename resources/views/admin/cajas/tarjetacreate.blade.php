@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Cierre</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(auth()->user()->role=="admin")
            <form method="post" action="{{ url('admin/cajas/tarjeta') }}" enctype="multipart/form-data">
            @else
            <form method="post" action="{{ url('usuario/cajas/tarjeta') }}" enctype="multipart/form-data">
            @endif
                {{csrf_field() }} 
                <input type="hidden" name="caja_id" value="{{$caja->id}}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" 
                            value ="{{old('detalle')}}"
                            name="detalle" required>  
                    </div>
                    <div class="form-group col-md-6">
                        <label for="importe">Importe</label>
                        <input type="text" class="form-control" 
                            value ="{{old('importe')}}"
                            name="importe" required>  
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="terminal_number">N° de Terminal</label>
                      <input type="text" class="form-control" 
                      value="{{old('terminal_number')}}"
                      name="terminal_number" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="lote_number">N° de Lote</label>
                      <input type="text" class="form-control" 
                      value="{{old('lote_number')}}" 
                      name="lote_number" required>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Registrar Cierre</button>
                        @if(auth()->user()->role=="admin")
                         <a href=" {{ url('/admin/cajas')}}" class="btn btn-default">Cancelar</a>
                        @else
                        <a href=" {{ url('/usuario/cajas')}}" class="btn btn-default">Cancelar</a>
                        @endif
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
