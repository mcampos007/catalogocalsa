@extends('layouts.app')

@section('title','Bienvenido a DigTab by Infocam')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section ">
            <h2 class="title text-center">Editar Categoria Seleccionada </h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/categories/'.$category->id.'/edit') }}" enctype="multipart/form-data">
                {{csrf_field() }}
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del categoria</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
                        </div>    
                    </div>
                </div>   
                <div class="form-group label-floating">  
                    Sector 
                    @foreach ($sectors as $key => $sector)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sector_id" id="exampleRadios1" value="{{ $key }}" @if($category->sector_id == $key+1) checked @endif>
                            <label class="form-check-label" for="sector">
                                {{ $sector->name}}
                            </label>
                        </div>
                    @endforeach    
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Descripción de la Categoría</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description',$category->description) }}">
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                            <label class="control-label">Imagen de la Categoría</label>
                            <input type="file" name="image" >
                            @if ( $category->image )
                            <p class="help-block">Subir solo si desea reemplazar la 
                                <a href="{{ asset('/images/categories/'.$category->image) }}" target="_blank">
                                imágen actual.</a>
                            </p>
                            @endif

                    </div>
                        
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href=" {{ url('/admin/categories')}}" class="btn btn-default">Cancelar</a>
            </form>

        </div>

    </div>

</div>

@include('includes.footer')
@endsection
