@extends('layouts.app')

@section('title','Agregar Item al pedido')

@section('body-class','profile-page')

@section('content')
<!-- <div class="header header-filter" style="background-image: url(' {{ asset('img/Demofondo1.jpeg') }}'); background-size: cover; background-position: top center;">
</div> -->


<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');">

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
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-alternative"  placeholder="Cantidad Pedida"  name="quantity" value = " {{ $cartdetail->quantity }}"/>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Stock Actual" class="form-control form-control-alternative" name="stockactual" value = "{{ $cartdetail->stocklocal }}"/>
                    </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <a href="{{ url('/usuario/precios')}}" type="button" class="btn btn-secondary">Cancelar</a>
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

