@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Cheque</h2>
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
            <form method="post" action="{{ url('admin/cajas/cheque/edit') }}" enctype="multipart/form-data">
            @else
            <form method="post" action="{{ url('usuario/cajas/cheque/edit') }}" enctype="multipart/form-data">
            @endif
                {{csrf_field() }} 
                <input type="hidden" name="id" value="{{$cheque->id}}">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="address">Fecha Emisión</label>
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar Fecha de Emisión" 
                            name ="fch_emision"
                            id = "date" type="text" value="{{ old('fch_emision',$cheque->fch_emision)}}" 
                            data-date-format="yyyy-mm-dd" 
                            data-date-start-date="{{ date('Y-m-d')}}"  
                            data-date-end-date="+30d"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="address">Fecha Cobro</label>
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker" placeholder="Seleccionar Fecha de Cobro" 
                            name ="fch_cobr"
                            id = "date" type="text" value="{{ old('fch_cobro',$cheque->fch_cobr)}}" 
                            data-date-format="yyyy-mm-dd" 
                            data-date-start-date="{{ date('Y-m-d')}}"  
                            data-date-end-date="+30d"
                            required>                
                    </div>   
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="importe">Importe</label>
                        <input type="text" class="form-control" 
                        value ="{{old('importe',$cheque->importe)}}"
                        name="importe" required>  
                    </div>
                    <div class="form-group col-md-4">
                      <label for="titular">Entregado por</label>
                      <input type="text" class="form-control" 
                      value="{{old('titular',$cheque->titular)}}"
                      name="titular" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="number">N° Cheque</label>
                      <input type="number" class="form-control" 
                      value="{{old('number', $cheque->number)}}" 
                      name="number" required>
                    </div>
                </div> 

                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="cliente">Cliente</label>
                      <select class="form-control" name="client_id" id="cliente" required>
                            <option value="{{$cheque->client_id}}" selected="">{{ $cheque->client->name}}</option>
                            @foreach($clients as $client)
                                <option value ="{{$client->id}}" @if(old('client_id')== $client->id) selected @endif>
                                    {{$client->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="banco">Banco</label>
                      <select class="form-control" id="banco" name="banco_id" required>
                        <option value="{{ $cheque->banco_id}}" selected="">{{$cheque->banco->name}}</option>
                        @foreach($bancos as $banco)
                            <option value ="{{$banco->id}}" 
                                @if(old('banco_id')== $banco->id) selected @endif>
                                {{$banco->name}}
                            </option>
                        @endforeach
                      </select>
                    </div>
                </div>               
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Actualizar Movimiento</button>
                        @if(auth()->user()->role=="admin")
                         <a href=" {{ url('/admin/cajas/'.$cheque->id.'/cheque')}}" class="btn btn-default">Cancelar</a>
                        @else
                         <a href=" {{ url('/usuario/cajas/'.$cheque->id.'/cheque')}}" class="btn btn-default">Cancelar</a>
                        @endif
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
