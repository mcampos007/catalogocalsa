@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Ingreso</h2>
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
            <form method="post" action="{{ url('admin/cajas/otrafp') }}" enctype="multipart/form-data">
            @else
            <form method="post" action="{{ url('usuario/cajas/otrafp') }}" enctype="multipart/form-data">
            @endif
                {{csrf_field() }} 
                <input type="hidden" name="caja_id" value="{{$caja->id}}">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="fecha">Fecha</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar Fecha de Emisión" 
                            name ="fecha"
                            id = "date" type="text" value="{{ old('fecha',date('Y-m-d'))}}" 
                            data-date-format="yyyy-mm-dd" 
                            data-date-start-date="{{ date('Y-m-d')}}"  
                            data-date-end-date="+30d"
                            required>                   
                    </div>
                    <div class="col-md-6">
                        <label for="cliente">Cliente</label>
                          <select class="form-control" name="client_id" id="cliente" required>
                                <option value="0" selected="">...</option>
                                @foreach($clients as $client)
                                    <option value ="{{$client->id}}" @if(old('client_id')== $client->id) selected @endif>
                                        {{$client->name}}
                                    </option>
                                @endforeach
                            </select>                           
                    </div>   
                </div>
                <div class="form-row">
                       
                </div> 
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cliente">Tipo de Ingreso</label>
                          <select class="form-control" name="tipomovimiento_id" id="tipomovimiento" required>
                            <option value="0" selected="">...</option>
                            @foreach($tipomovimientos as $tipomovimiento)
                                <option value ="{{$tipomovimiento->id}}" @if(old('tipomovimiento_id')== $tipomovimiento->id) selected @endif>
                                    {{$tipomovimiento->name}}
                                </option>
                            @endforeach
                        </select>   
                    </div>
                    <div class="form-group col-md-4">
                      <label for="detalle">Detalle</label>
                      <input type="text" class="form-control" 
                      value="{{old('detalle')}}"
                      name="detalle" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="importe">Importe</label>
                      <input type="importe" class="form-control" 
                      value="{{old('importe')}}" 
                      name="importe" required>
                    </div>
                </div> 

                <div class="form-row">
                    <div class="form-group col-md-6">
                      
                    </div>
                    <div class="form-group col-md-6">
                      
                    </div>
                </div>               
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Registrar Ingreso</button>
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
