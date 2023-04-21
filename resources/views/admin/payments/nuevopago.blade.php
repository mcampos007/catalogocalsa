@extends('layouts.app')

@section('title','Registro de Pagos')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url(' {{ asset('img/demofondo1.jpg') }}');background-size: cover; background-position: top center;">
</div>

<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <h2 class="title">Registro de Pagos</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ url('admin/pagos') }}">
                
                <div class="team">
                    <!-- Cliente -->
                    
                    {{csrf_field() }}
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <div class="row">
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Cliente: {{ $client->name }} ({{ $client->id }} )" rows="3">
                                Cliente: {{ $client->name }} ({{ $client->id }} )
                            </textarea>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">#</th>
                                        <th class="col-md-6 text-center">Comprobante</th>
                                        <th class="col-md-6 text-center">Importe</th>
                                        <th class="col-md-6 text-center">Saldo</th>
                                        <th class="col-md-6 text-center">Pago</th>
                                        <th class="text-right">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $key =>$invoice)
                                        <input type="hidden" name="cantfact" value="{{ $key }}">
                                            @if ( $invoice->total - $invoice->acuenta !=0  ){
                                            <tr>
                                                <td class="text-center"><input type="hidden" name="fact[{{$key}}]" value="{{ $invoice->id }}"></td>
                                                <td class="text-center" >{{ $invoice->id }}</td>
                                                <td >{{ $invoice->invoice_date }}</td>
                                                <td >{{ $invoice->total }}</td>
                                                <td >{{ $invoice->total - $invoice->acuenta }}</td>
                                                <td > <input type="number"  name="pago[{{$key}}]" value=""></td>
                                                <td class="td-actions text-right">                                    
                                                    <a href="{{ url('/admin/pagos/'.$client->id.'/nuevopago')}}" type="button" rel="tooltip" title="Registrar Pago" class="btn btn-info btn-simple btn-xs" >
                                                    <i class="fa fa-info"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            }
                                            @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                 <a href=" {{ url('/admin/pagos')}}" class="btn btn-default">Cancelar</a>
            </form>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection
