
   <h2 class="title">OTRAS FORMAS DE PAGO</h2>
    <table class="table-responsive table-hover  table-striped">
        <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Cliente</th>    
                <th class="col-md-2 text-center">Tipo</th>
                <th class="col-md-2 text-center">Detalle</th>
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($otrosfp as $otrofp)
            <tr>
                <td class="col-md-2 text-center">{{$otrofp->id}}</td>
                <td class="col-md-2 text-center">{{$otrofp->client->name}}</td>    
                <td class="col-md-2 text-center">{{$otrofp->tipomovimiento->name}}</td>
                <td class="col-md-2 text-center">{{$otrofp->detalle}}</td>    
                <td class="col-md-2 text-right">{{$otrofp->importe}}</td>
            </tr>
            @endforeach    
            <tr>
                <td class="col-md-2 text-center  bg-primary " colspan="4">Total</td>    
                <td class="col-md-2 text-right  bg-primary ">{{$sumotrosfp}}</td>
            </tr>
        </tbody>
    </table> 
