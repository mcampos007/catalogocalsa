@extends('layouts.app')
@section('title','Bienvenido a '. config('app.name'))

@section('body-class','landing-page')

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
<!--<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
-->
<div class="header header-filter" style="background-image: url(' {{ asset("img/demofondo1.jpg") }}'); background-size: cover; background-position: top center;">

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="title">Bienvenido a {{ config('app.name') }}</h1>
                <h4>Llevamos 32 años acompañando a los panaderos  en el crecimiento de sus negocios ofreciendo la más alta calidad en insumos. Nuestro personal especializado lo asesoran para incorporar nuevas tecnologías para lograr aumentar la eficiencia de su negocio.</h4>
                <h4>Acompañandote desde 1988"</h4>
                <br />

                <a href="#" class="btn btn-danger btn-raised btn-lg">
                    <i class="fa fa-play"></i> ¿Quienes Somos?
                </a>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="container">        
           <!-- <div class="section text-center section-landing">
            <div class="team">
                <h2 class="title">Nuestras Promociones</h2>
                <div class="row">
                    @foreach($promotions as $promotion)
                    <div class="col-md-4">
                        <div class="team-player">
                            <img src="{{ $promotion->featured_image_url }}" alt="Thumbnail Image" class="img-raised img-circle"width="200" height="200">   
                            <h4 class="title">{{ $promotion->name }} <br />
                            </h4>
                            <p class="description">{{ $promotion->description }}</p>                     
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    {{ $promotions->links()}}
                </div>
            </div>
        </div> -->        
        <div class="section text-center">
            <h2 class="title">Todo lo que tenemos para vos</h2>
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

        <div class="section landing-section">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center title">Nos interesa tu opinión</h2>
                    <h4 class="text-center description">Por favor, dedique un momento a completar este pequeño formulario, la información que nos proporcione será utilizada para mejorar nuestro servicio.

                    Sus respuestas serán tratadas de forma confidencial y no serán utilizadas para ningún propósito distinto mencionado..</h4>
                    <form class="contact-form" action="{{ url('/feedback') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tu Nombre</label>
                                    <input type="text" class="form-control" name="nombrecliente">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tu correo electrónico</label>
                                    <input type="email" class="form-control" name="emailcliente">
                                </div>
                            </div>
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">Tu mensaje</label>
                            <textarea class="form-control" rows="4" name="txtmensaje"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <button type="submit" class="btn btn-primary btn-raised">
                                    Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>
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