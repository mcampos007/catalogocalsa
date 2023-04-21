<!doctype html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
 <style>
    @page {
        margin-left: 0.5cm;
        margin-right: 0;
    }
</style>
</head>

<body>
    <!--   Cabeceera   -->
    <div id="details" class="clearfix">
        <div id="invoice">
          <h3>Planilla de Caja N° {{$caja->id}}</h3>
          <div class="date">Fecha  {{$caja->fecha}} Sucursal: {{$caja->puntodeventa->name}} Usuario: {{$caja->user->name}}</div>
        </div>
    </div>
    <!--   Arqueo y Tarjeta   -->
    <table border="0" cellspacing="0" cellpadding="0" class="table" style="font-size:8px" >
        <thead>
            <tr>
                <th>Arqueo</th>
                <th>Tarjetas</th>
            </tr>
        </thead> 
                <tbody>
            <tr>
                <td>
                    <table class="table table-sm" >
                        <thead>
                            <tr>
                                <th>Denominación</th>
                                <th>Cantiad </th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>$Mil</td>
                                <td>{{ $efectivo->billete1000 }}</td>
                                <td>{{ 1000 * $efectivo->billete1000 }}</td>
                            </tr>
                            <tr>
                                <td>$Quinientos</td>
                                <td>{{ $efectivo->billete500 }}</td>
                                <td>{{ 500 * $efectivo->billete500 }}</td>
                            </tr>
                            <tr>
                                <td>$Doscientos</td>
                                <td>{{ $efectivo->billete200 }}</td>
                                <td>{{ 200 * $efectivo->billete200 }}</td>
                            </tr>
                            <tr>
                                <td>$Cien</td>
                                <td>{{ $efectivo->billete100 }}</td>
                                <td>{{ 100 * $efectivo->billete100 }}</td>
                            </tr>
                            <tr>
                                <td>$Cincuenta</td>
                                <td>{{ $efectivo->billete50 }}</td>
                                <td>{{ 50 * $efectivo->billete50 }}</td>
                            </tr>
                            <tr>
                                <td>$Veinte</td>
                                <td>{{ $efectivo->billete20 }}</td>
                                <td>{{ 20 * $efectivo->billete20 }}</td>
                            </tr>
                            <tr>
                                <td>$Diez</td>
                                <td>{{ $efectivo->billete10 }}</td>
                                <td>{{ 10 * $efectivo->billete10 }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Total de Efectivo</td>
                                <td>{{$totbillete}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Detalle</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tarjetas as $tarjeta)
                            <tr>
                                <td>{{ $tarjeta->id }}</td>
                                <td>{{ $tarjeta->detalle }}</td>
                                <td>{{ $tarjeta->importe }}</td>
                            </tr>
                            @empty

                            @endforelse
                            <tr>
                                <td colspan="2">Total Ventas con Tarjetas</td>
                                <td>{{$sumtarjetas}}</td>
                            </tr>
                        </tbody>
                    </table>
            </td>
            </tr>
        </tbody>  
    </table>
    
    <!--   Cheques   -->
    <table border="0" cellspacing="0" cellpadding="0" class="table" >
        <thead>
            <tr>
                <th >Cheques</th>             
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table table-sm" style="font-size:8px" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>F.Emisión </th>
                                <th>F.Cobro</th>
                                <th>Entregado por </th>
                                <th>Titular</th>
                                <th>Banco</th>
                                <th>Número</th>
                                <th>Importe</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cheques as $cheque)
                            <tr>
                                <td>{{ $cheque->id }}</td>
                                <td>{{ $cheque->fch_emision }}</td>
                                <td>{{ $cheque->fch_cobr }}</td>
                                <td>{{ $cheque->client->name }}</td>
                                <td>{{ $cheque->titular }}</td>
                                <td>{{ $cheque->banco->name }}</td>
                                <td>{{ $cheque->number }}</td>
                                <td>{{ $cheque->importe }}</td>
                                <td>{{ $cheque->estadocheque->estado }}</td>
                            </tr>
                            @empty

                            @endforelse
                            <tr>
                                <td colspan="7">Total Cheques</td>
                                <td>{{$sumcheques}}</td>
                                <td></td>
                            </tr>   
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

        <!--   Otras Formas de Pago   -->
    <table border="0" cellspacing="0" cellpadding="0" class="table" style="font-size:8px" >
        <thead>
            <tr>
                <th >Otras Formas de Pago</th>             
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table table-sm" style="font-size:8px" cellspacing="0" cellpadding="0" >
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Cliente </th>
                                <th>Tipo</th>
                                <th>Detalle</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($otrosfp as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->client->name }}</td>
                                <td>{{ $pago->tipomovimiento->name }}</td>
                                <td>{{ $pago->detalle }}</td>
                                <td>{{ $pago->importe }}</td>
                            </tr>
                            @empty

                            @endforelse
                            <tr>
                                <td colspan="4">Total Ingresos Otros Pagos</td>
                                <td>{{$sumotrosfp}}</td>
                            </tr>   
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <!--   Gastos y Resúmen   -->
    <table class="table " style="font-size:8px" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>Gastos</th>
                <th>Resúmen</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Detalle </th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gastos as $gasto)
                            <tr>
                                <td>{{ $gasto->id }}</td>
                                <td>{{ $gasto->detalle }}</td>
                                <td>{{ $gasto->importe }}</td>
                            </tr>
                            @empty

                            @endforelse
                            <tr>
                                <td colspan="2">Total de Gastos</td>
                                <td>{{$sumgasto}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <td>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Detalle</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Gastos</td>
                                    <td>{{ $sumgasto  }}</td>
                                </tr>
                                <tr>
                                    <td>Total A rendir</td>
                                    <td>{{ $caja->totalplanilla - $sumgasto  }}</td>
                                </tr>
                                <tr>
                                    <td>Total Efectivo</td>
                                    <td>{{  $totbillete }}</td>
                                </tr>
                                <tr>
                                    <td>Total Tarjetas</td>
                                    <td>{{ $sumtarjetas  }}</td>
                                </tr>
                                <tr>
                                    <td>Total Cheques</td>
                                    <td>{{  $sumcheques }}</td>
                                </tr>
                                <tr>
                                    <td>Total Otros FP</td>
                                    <td>{{ $sumotrosfp}}</td>
                                </tr>

                                <tr>
                                    <td>Total Rendido</td>
                                    <td> {{$totbillete + $sumotrosfp + $sumtarjetas + $sumcheques  }} </td>
                                </tr>
                                <tr>
                                    <td>Diferencia</td>
                                    <td>{{round( $caja->totalplanilla - $sumgasto - ($totbillete +  $sumtarjetas + $sumcheques + $sumotrosfp),2) }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </td>
                </td>
            </td>
            </tr>
        </tbody>
    </table>

        
</body>
    <!--   Core JS Files   -->
    <script src=" {{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
</html>
