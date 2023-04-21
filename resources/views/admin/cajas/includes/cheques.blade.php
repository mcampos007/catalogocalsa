
   <h2 class="title">CHEQUES</h2>
    <table class="table-responsive table-hover  table-striped">
        <thead>
            <tr>
                <th class="col-md-2 text-center">#</th>
                <th class="col-md-2 text-center">Fch Emisión</th>    
                <th class="col-md-2 text-center">Fch Cobro</th>
                <th class="col-md-2 text-center">Entregado Por</th>
                <th class="col-md-2 text-center">Titular</th>
                <th class="col-md-2 text-center">Banco</th>
                <th class="col-md-2 text-center">Numero</th>
                <th class="col-md-2 text-center">Importe</th>
                <th class="col-md-2 text-center">Estado</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($cheques as $cheque)
            <tr>
                <td class="col-md-2 text-center">{{$cheque->id}}</td>
                <td class="col-md-2 text-center">{{$cheque->fch_emision}}</td>    
                <td class="col-md-2 text-center">{{$cheque->fch_cobr}}</td>
                <td class="col-md-2 text-center">{{$cheque->client->name}}</td>    
                <td class="col-md-2 text-right">{{$cheque->titular}}</td>
                <td class="col-md-2 text-center">{{$cheque->banco->name}}</td>    
                <td class="col-md-2 text-center">{{$cheque->number}}</td>
                <td class="col-md-2 text-center">{{$cheque->importe}}</td>    
                <td class="col-md-2 text-center">{{$cheque->estadocheque->estado}}</td>    
            </tr>
            @endforeach    
            <tr>
                <td class="col-md-2 text-center  bg-primary " colspan="7">Total</td>    
                <td class="col-md-2 text-right  bg-primary ">{{$sumcheques}}</td>
            </tr>
        </tbody>
    </table> 
