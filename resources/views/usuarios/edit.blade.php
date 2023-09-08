@extends('layouts.app')

@section('title','Agregar Item al pedido')

@section('body-class','profile-page')

@section('content')
<!-- <div class="header header-filter" style="background-image: url(' {{ asset('img/Demofondo1.jpeg') }}'); background-size: cover; background-position: top center;">
</div> -->


<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}');">

</div>
<div class="main main-raised">
    <div class="container">
        <h2 class="title">Código: {{$cartdetail->product->id }} - {{$cartdetail->product->name }}</h2>
    </div>
    <div class="container">
        <form method="post" action=" {{ url('/usuario/cart/edit') }}">
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{$cartdetail->product->id }}">
            <input type="hidden" name="cartdetail_id" value="{{$cartdetail->id }}">
             <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity">Cantidad:</label>
                      <input type="text" class="form-control "  name="quantity" value = " {{ $cartdetail->quantity }}"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="price">Precio:</label>
                      <input type="text" step="0.01" class="form-control"  name="price" value = " {{ $cartdetail->price }}" disabled />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="descuento">% Descuento:</label>
                      <input type="text" step="0.01"  class="form-control form-control-alternative" name="descuento" value = "{{ $cartdetail->discount }}"/>
                    </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <a href="{{ url('/home')}}" type="button" class="btn btn-secondary">Cancelar</a>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Actualizar el Pedido</button>
                    </div>
                  </div>
            </div>
        </form>
    </div> 

</div>

@include('includes.footer')
@endsection

