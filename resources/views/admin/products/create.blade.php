@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Registrar Nuevo Producto</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/products') }}">
                {{csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                     <!--<div class="col-auto my-1"> -->
                         <label class="form-group label-floating">Categoría  Seleccionada  </label>
                         <select  class= "form-control" name="category_id" value="{{ old('category_id') }}">
                             <option value="0">General</option>
                             @foreach($categories as $category)
                             {
                                <option value="{{$category->id}}">{{$category->name}}</option>   
                             }
                             @endforeach
                         </select>
                     </div>
                 </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del Producto</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name')}}">
                        </div>    
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Código</label>
                            <input type="text" class="form-control" name="nro_art" value="{{ old('nro_art')}}">
                        </div>    
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Precio del  Producto</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price')}}">
                        </div>
                    </div>    
                </div>
                
                <div class="form-group label-floating">
                        <label class="control-label">Descripción</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description')}}">
                </div>
                

          

                <textarea class="form-control" placeholder="Descipción extensa del Producto" rows="5" name="long_description">{{ old('long_description')}}</textarea>
                
                <button type="submit" class="btn btn-primary">Registrar Producto</button>
                 <a href=" {{ url('/admin/products')}}" class="btn btn-default">Cancelar</a>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
