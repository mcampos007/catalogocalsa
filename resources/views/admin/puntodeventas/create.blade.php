@extends('layouts.app')

@section('title','Creación de un nuevo Punto de venta')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Punto de Venta</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/puntodeventa') }}" enctype="multipart/form-data">
                {{csrf_field() }}              
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del Punto de Venta</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name')}}">
                        </div>    
                    </div>
                        
                </div>

                <button type="submit" class="btn btn-primary">Registrar Punto de Venta</button>
                 <a href=" {{ url('/admin/sectors')}}" class="btn btn-default">Cancelar</a>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
