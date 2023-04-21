@extends('layouts.app')
@section('title','Precios '. config('app.name'))

@section('body-class','profile-page')

@section('styles')
    <style >
        .team .row .col-md-4 {
            margin-bottom: 5em;
            /*margin-top: 5em;*/
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

        .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
        .tt-hint {
            width: 396px;
            height: 30px;
            padding: 8px 12px;
            font-size: 24px;
            line-height: 30px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            }

         .tt-query {
          -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
             -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
              color: #999
            }

            .tt-menu {    /* used to be tt-dropdown-menu in older versions */
              width: 222px;
              margin-top: 4px;
              padding: 4px 0;
              background-color: #fff;
              border: 1px solid #ccc;
              border: 1px solid rgba(0, 0, 0, 0.2);
              -webkit-border-radius: 4px;
                 -moz-border-radius: 4px;
                      border-radius: 4px;
              -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                 -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                      box-shadow: 0 5px 10px rgba(0,0,0,.2);
            }
            #divprecios {
                position:relative;
                top:-700px;
                left:5px;
            }

    </style> 

@endsection
@section('content')
<!--<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
-->
{{-- <div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}'); background-size: cover; background-position: top center;"> 
</div> --}}
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');"></div>

<div class="main main-raised">
    <div class="container">
        <h2 class="title">Listado de Productos Fiambres</h2>
    </div>
    <div class="profile-content">
        <div class="container">
            <div class="row">
            <div class="col-x1-12">
                <form action="{{url('preciosf')}}" method="GET">  
                    <div class="form-row">
                        <div class="col-sm-4 my-1">
                            <input type="text" name="texto" class="form-control" value="{{$texto}}">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn btn-primary" value="Buscar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-x1-12">
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
                        {{ $product->price * $recargo}}
                      </td>
                      <td scope="row">
                        {{ $product->topedesc}}
                      </td>
                      <td scope="row">
                        {{ $product->con_descuento * $recargo}}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="text-center">
                    {!! $products->appends(["texto" => $texto]) !!}
                    {{-- {{ $products->links() }}  --}}   
                </div>
                
            </div>
        </div>
        </div>
        
    </div>  
</div>

@include('includes.footer')
@endsection

@section('scripts')
    {{-- <script src=" {{ asset('js/typeahead.bundle.min.js')}}" type="text/javascript"></script>
    <script >
        $(function(){
            // Inicializar typeahead sobre nuestro input de busqueda
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              // `states` is an array of state names defined in "The Basics"
              prefetch: '{{ url("/precios/json")}}'
            });

            $('#search').typeahead({
                hint:true,
                highlight: true,
                minLength:1
            },{
                name:'products',
                source:products
            })
        });
    </script> --}}
@endsection