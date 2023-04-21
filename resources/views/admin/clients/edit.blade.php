@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Cliente Seleccionado </h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/clients/'.$client->id.'/edit') }}" enctype="multipart/form-data">
                {{csrf_field() }}
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del cliente</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $client->name) }}">
                        </div>    
                    </div>
                   
                </div>
                
                
                <div class="form-group label-floating">
                    <label class="control-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="{{ old('direccion',$client->direccion) }}">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">e-mail</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email',$client->email) }}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href=" {{ url('/admin/clients')}}" class="btn btn-default">Cancelar</a>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
