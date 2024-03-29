@extends('layouts.app')

@section('title','Todas nuestras Propuestas')

@section('body-class','product-page')

@section('styles')
<style >
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

</style>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}');background-size: cover; background-position: top center;">
</div>
<div class="main main-raised">
    <div class="container">
        <!-- Notifiaciones -->
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('notification') }}</strong>
                    </div>
                @endif
        
        <div class="container">
            <div class="section text-center">
                <h2 class="title">Pedido Actual {{ $cart->id}}</h2>
                <form class="form-inline" method="get" action="{{ url('search')}}">
                    <input type="text" placeholder="¿Que estas buscando?" name="query" class="form-control" id="search">
                    <button class="btn btn-primary btn-just-icon" type="submit">
                        <i class="material-icons">search</i>
                    </button>
                </form>
                <div class="team">
                    <div class="row">
                        @foreach($categories as $category)
                        <div class="col-md-4">
                            <div class="team-player">

                                <img src="{{ $category->featured_Image_url }}" alt="Imágen de la Categoria" class="img-raised img-circle">
                                
                                <h4 class="title">
                                    <a href="{{ url('/categories/'.$category->id) }}">{{ $category->name }}    </a>
                                    
                                    
                                </h4>
                                <p class="description">{{ $category->description }}</p>
                               
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                         
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('includes.footer')
@endsection

@section('scripts')
    <script src=" {{ asset('js/typeahead.bundle.min.js')}}" type="text/javascript"></script>
    <script >
        $(function(){
            // Inicializar typeahead sobre nuestro input de busqueda
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              // `states` is an array of state names defined in "The Basics"
              prefetch: '{{ url("/products/json")}}'
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
    </script>
@endsection