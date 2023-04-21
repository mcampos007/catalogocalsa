@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Egreso</h2>
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
            <form method="post" action="{{ url('admin/cajas/egreso') }}" enctype="multipart/form-data">
            @else
            <form method="post" action="{{ url('usuario/cajas/egreso') }}" enctype="multipart/form-data">
            @endif
                {{csrf_field() }} 
                <input type="hidden" name="caja_id" value="{{$caja->id}}">
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
                        <input type="text" class="form-control" id="detalle" name="detalle" requiered>  
                    </div>
                    <div class="form-group col-md-6">
                      <label for="importe">importe del movimiento</label>
                      <input type="number" class="form-control" id="importe" name="importe" required>
                    </div>
                </div> 

{{--                 <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="puntodeventa">Detalle</label>
                      <select id="puntodeventa_id" class="form-control" 
                        id="puntodeventa" name="puntodeventa_id" required>
                        <option value="0" selected="">...</option>
                        @foreach($puntodeventas as $puntodeventa)
                            <option value ="{{$puntodeventa->id}}" @if(old('puntodeventa_id')== $puntodeventa->id) selected @endif>
                                {{$puntodeventa->name}}
                            </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="user">Usuario</label>
                      <select id="user" class="form-control" name="user_id" required>
                        <option value="0" selected="">...</option>
                        @foreach($users as $user)
                            <option value ="{{$user->id}}">{{$user->name}} @if(old('user_id')== $user->id) selected @endif</option>
                        @endforeach
                      </select>
                    </div>
                    
                </div>
 --}}
                
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        @if(auth()->user()->role=="admin")
                        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                         <a href=" {{ url('/admin/cajas')}}" class="btn btn-default">Cancelar</a>
                        @else
                        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
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
