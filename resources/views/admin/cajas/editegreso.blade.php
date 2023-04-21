@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Egreso</h2>
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
            <form method="post" action="{{ url('admin/cajas/egreso/edit') }}" enctype="multipart/form-data">
            @else
            <form method="post" action="{{ url('usuario/cajas/egreso/edit') }}" enctype="multipart/form-data">
            @endif            
                {{csrf_field() }} 
                <input type="hidden" name="id" value="{{$gasto->id}}">
                <div class="form-row">
                    <label for="address">Fecha</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="Seleccionar Fecha" 
                        name ="fecha"
                        id = "date" type="text" value="{{ old('fecha',date('Y-m-d'))}}" 
                        data-date-format="yyyy-mm-dd" 
                        data-date-start-date="{{ date('Y-m-d')}}"  
                        data-date-end-date="+30d"
                        required>
                    </div>   
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="detalle">Descripción del Movimiento</label>
                        <input type="text" class="form-control" id="detalle" name="detalle" 
                        value=" {{ old('detalle',$gasto->detalle) }}" requiered>  
                    </div>
                    <div class="form-group col-md-6">
                      <label for="importe">importe del movimiento</label>
                      <input type="number" class="form-control" id="importe" name="importe" 
                      value ="{{ old('importe',$gasto->importe)}}" required>
                    </div>
                </div>                 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Actualizar Movimiento</button>
                        @if(auth()->user()->role=="admin")
                         <a href=" {{ url('/admin/cajas/'.$gasto->id.'/egreso')}}" class="btn btn-default">Cancelar</a>
                        @else
                        <a href=" {{ url('/admin/cajas/'.$gasto->id.'/egreso')}}" class="btn btn-default">Cancelar</a>
                        @endif
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
