<h2 class="title">RESUMEN</h2>
    <table class="table-responsive table-hover  table-striped">
        {{-- <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Fecha</th>    
                <th class="col-md-2 text-center">Detalle</th>    
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead> --}}
        <tbody>
            <tr>
                <td class="col-md-2 text-center">TOTAL PLANILLA</td>
                <td class="col-md-2 text-right">{{$caja->totalplanilla}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">TOTAL GASTOS</td>
                <td class="col-md-2 text-right">{{$sumgasto}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center bg-primary ">Total a Rendir</td>    
                <td class="col-md-2 text-right bg-primary ">{{$caja->totalplanilla -$sumgasto}}</td>
            </tr>
        </tbody>
    </table> 
    <table class="table-responsive table-hover  table-striped">
        {{-- <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Fecha</th>    
                <th class="col-md-2 text-center">Detalle</th>    
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead> --}}
        <tbody>
            <tr>
                <td class="col-md-2 text-center">TOTAL EFECTIVO</td>
                <td class="col-md-2 text-right">{{$totbillete}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">TOTAL TARJETAS</td>
                <td class="col-md-2 text-right">{{$sumtarjetas}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">TOTAL CHEQUES</td>
                <td class="col-md-2 text-right">{{$sumcheques}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center">TOTAL OTRO F.P</td>
                <td class="col-md-2 text-right">{{$sumotrosfp}}</td>    
            </tr>
            <tr>
                <td class="col-md-2 text-center bg-primary ">Total Rendido</td>    
                <td class="col-md-2 text-right bg-primary ">{{$totbillete + $sumcheques + $sumotrosfp + $sumtarjetas}}</td>
            </tr>
            @if($caja->totalplanilla - $totbillete - $sumcheques - $sumotrosfp -$sumgasto - $sumtarjetas > 0)
            <tr>
                <td class="col-md-2 text-center bg-danger ">Faltante</td>    
                <td class="col-md-2 text-right bg-danger ">{{round($caja->totalplanilla - $totbillete - $sumcheques - $sumotrosfp -$sumgasto - $sumtarjetas,2)}}</td>
            </tr>
            @else
                <tr>
                <td class="col-md-2 text-center bg-primary ">Sobrante</td>    
                <td class="col-md-2 text-right bg-primary ">{{round($caja->totalplanilla - $totbillete - $sumcheques - $sumotrosfp - $sumgasto - $sumtarjetas,2)}}</td>
                </tr>
            @endif
        </tbody>
    </table> 
</div>