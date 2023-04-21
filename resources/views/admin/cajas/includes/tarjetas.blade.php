
   <h2 class="title">TARJETAS</h2>
    <table class="table-responsive table-hover  table-striped">
        <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Terminal</th>    
                <th class="col-md-2 text-center">Lote</th>
                <th class="col-md-2 text-center">Importe</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($tarjetas as $tarjeta)
            <tr>
                <td class="col-md-2 text-center">{{$tarjeta->id}}</td>
                <td class="col-md-2 text-center">{{$tarjeta->terminal_number}}</td>    
                <td class="col-md-2 text-center">{{$tarjeta->lote_number}}</td>   
                <td class="col-md-2 text-right">{{$tarjeta->importe}}</td>
            </tr>
            @endforeach    
            <tr>
                <td class="col-md-2 text-center  bg-primary " colspan="4">Total</td>    
                <td class="col-md-2 text-right  bg-primary ">{{$sumtarjetas}}</td>
            </tr>
        </tbody>
    </table> 
