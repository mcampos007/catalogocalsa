@extends('layouts.app')

@section('title','Bienvenido a Aristaeus Panel de Control')

@section('body-class','profile-page')

@section('styles')
    <style>
        .team{
            padding-bottom: 50px;
        }
        .team .row .col-md-4 {
            margin-bottom: 5em;
        }

        .team .row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -webkit-flexbox;
            display: -ms-flexbox;
            display: flex;
            flex-wrap:wrap;
        }
        .team .row > [class*='col-']{
            display: flex;
            flex-direction: column;
        }
    </style>
@endsection

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
                        <img src=" {{ url($category->featured_Image_url) }} " alt="Imágen de la Categoria {{ $category->name }}" class="img-circle img-responsive img-raised">
                    </div>

                    <div class="name">
                        <h3 class="title">{{$category->name }}</h3>
                    </div>
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="description text-center">
                <p>{{ $category->description }} </p>
            </div>
            <div class="team text-center" >
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="team-player">
                            <img src="{{ url($product->featured_image_url) }}" alt="Thumbnail Image" class="img-raised img-circle">
                            
                            <h4 class="title">
                                <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}    </a>
                                
                            </h4>
                            <p class="description">{{ $product->description }}</p>
                            <span class="label label-info">Precio: {{ $product->price }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    
                     {{ $products->links() }}
                    
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Modal Core -->

@include('includes.footer')
@endsection
