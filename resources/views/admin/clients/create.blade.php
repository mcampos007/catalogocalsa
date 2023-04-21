@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Cliente</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/clients') }}" enctype="multipart/form-data">
                {{csrf_field() }}              
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name')}}">
                        </div>    
                    </div>
                        
                </div>
                
                <div class="form-group label-floating">
                        <label class="control-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="{{ old('direccion')}}">
                </div>
                
                <div class="form-group label-floating">
                        <label class="control-label">E-mail</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email')}}">
                </div>

                <div class="form-group label-floating">
                        <label class="control-label">C.U.I.T.</label>
                        <input type="text" class="form-control" name="cuit" value="{{ old('cuit')}}">
                </div>
                 
                        
                </div>

                <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                 <a href=" {{ url('/admin/clients')}}" class="btn btn-default">Cancelar</a>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
