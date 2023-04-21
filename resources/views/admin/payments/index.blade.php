@extends('layouts.app')

@section('title','Registro de Pagos')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Seleccione Cliente para registrar el Pago</h2>

            <div class="team">
                <div class="row">
                    <!-- <a href="{{ url('/admin/payments/create')}}" class="btn btn-primary btn-round">Nuevo Pago</a> -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Cliente</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saldos as $client)
                            <tr>
                                <td class="text-center">{{ $client->client_id }}</td>
                                <td>{{ $client->name }}</td>
                                <td class="td-actions text-right">                                    
                                    <a href="{{ url('/admin/pagos/'.$client->client_id.'/nuevopago')}}" type="button" rel="tooltip" title="Registrar Pago" class="btn btn-info btn-simple btn-xs" >
                                    <i class="fa fa-info"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $saldos->links() }}    
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer')
@endsection
