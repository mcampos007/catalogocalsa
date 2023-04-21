
   <h2 class="title">GASTOS/EGRESO</h2>
    <table class="table-responsive table-hover  table-striped">
        <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Fecha</th>    
                <th class="col-md-2 text-center">Detalle</th>    
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($gastos as $gasto)
            <tr>
                <td class="col-md-2 text-center">{{$gasto->id}}</td>
                <td class="col-md-2 text-center">{{$gasto->fecha}}</td>    
                <td class="col-md-2 text-center">{{$gasto->detalle}}</td>    
                <td class="col-md-2 text-right">{{$gasto->importe}}</td>
            </tr>
            @endforeach    
            <tr>
                <td class="col-md-2 text-center  bg-primary " colspan="3">Total</td>    
                <td class="col-md-2 text-right  bg-primary ">{{$sumgasto}}</td>
            </tr>
        </tbody>
    </table> 
