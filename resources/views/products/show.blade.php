@extends('layouts.app')

@section('title','Bienvenido a Aristaeus Panel de Control')

@section('body-class','profile-page')

@section('content')
<!-- <div class="header header-filter" style="background-image: url(' {{ asset('img/Demofondo1.jpeg') }}'); background-size: cover; background-position: top center;">
</div> -->


<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src=" {{ url($product->featured_image_url) }} " alt="Circle Image" class="img-circle img-responsive img-raised">
                        <div class="name">
                            <h3 class="title">{{$product->name }}</h3>
                            <h6>{{ $product->category->name }}</h6>
                        </div>
                        @if (session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>{{ $product->long_description }} </p>
            </div>

            <div class="text-center">
                @if (auth()->check())
                    <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#ModalAddToCart">
                        <i class="material-icons">add</i> Agregar al Pedido
                    </button>
                    <a href=" {{ url('/home') }}" class="btn btn-primary btn-round" >
                        <i class="material-icons">list</i> Ver el Pedido
                    </a>
                    <a href=" {{ url('/') }}" class="btn btn-primary btn-round" >
                        <i class="material-icons">pending</i> Lista de Productos
                    </a>
                @else
                    <a href=" {{ url('/login?redirect_to='.url()->current()) }}" class="btn btn-primary btn-round" >
                        <i class="material-icons">add</i> Agregar al Pedido
                    </a>
                    <a href=" {{ url('/home') }}" class="btn btn-primary btn-round" >
                        <i class="material-icons">list</i> Regresar a la lista de Productos
                    </a>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="profile-tabs">
                        <div class="nav-align-center">
                            <ul class="nav nav-pills" role="tablist">
                            <div class="tab-content gallery">
                                <div class="tab-pane active" id="studio">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @foreach($imagesLeft as $image)
                                            <img src="{{ url($image->url) }}" class="img-rounded" />
                                            <span class="label label-info">Precio: {{ $product->price }}</span>
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            @foreach($imagesRight as $image)
                                            <img src="{{ url($image->url) }}" class="img-rounded" />
                                            <span class="label label-info">Precio: {{ $product->price }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Profile Tabs -->
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Core -->
<div class="modal fade" id="ModalAddToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Seleccione la Cantidad que desea Agregar</h4>
      </div>
      <form method="post" action=" {{ url('/cart') }}">
        {{ csrf_field() }}
        <input type="hidden" name="product_id" value=" {{ $product->id }} ">
        <input type="hidden" name="price" value=" {{ $product->price }} ">
          <div class="modal-body">
            <input type="number" name="quantity" value="1" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info btn-simple">Añadir al Pedido</button>
          </div>
      </form>
    </div>
  </div>
</div>

@include('includes.footer')
@endsection

