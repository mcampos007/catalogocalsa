@extends('layouts.app')

@section('title','Resultados de Búsqueda')

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


<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="/img/search.jpg" alt="Imágen de una Lupa" class="img-circle img-responsive img-raised">
                    </div>

                    <div class="name">
                        <h3 class="title">Resultados de búsquedas</h3>
                    </div>
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="description text-center">
                <p>Se encontraron {{ $products->count() }} resultados para tu consulta, {{ $query }}</p>
            </div>
            <div class="team text-center" >
                <div class="row">
                    
                    <div class="table-responsive">
                        <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Código</th>
                                  <th scope="col">Artículo</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Descuento Max</th>
                                  <th scope="col">Precio c/Descuento</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($products as $product)
                                <tr>
                                  <td scope="row">
                                    {{ $product->id}}
                                  </td>
                                  <td scope="row">
                                    {{ $product->nro_art}}
                                  </td>
                                  <td scope="row">
                                    {{ $product->name}}
                                  </td>
                                  <td scope="row">
                                    {{ $product->price}}
                                  </td>
                                  <td scope="row">
                                    {{ $product->topedesc}}
                                  </td>
                                  <td scope="row">
                                    {{ $product->con_descuento}}
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <div class="text-center">
                                {{ $products->links() }}    
                            </div>
                    </div>
                    
                </div>
                
            </div>


        </div>
    </div>
</div>



@include('includes.footer')
@endsection
