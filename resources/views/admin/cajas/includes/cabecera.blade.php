<h2 class="title">Cierre de Caja N° {{$caja->id}}</h2>
<table class="table-responsive table-hover  table-striped">
    <tr>
        <th class="col-md-2 text-center">#</th>
        <th class="col-md-2 text-center">Fecha</th>    
        <th class="col-md-2 text-center">Responsable</th>    
    </tr>
    
    <tbody>
        <tr>
            <td class="col-md-2 text-center">{{$caja->id}}</td>
            <td class="col-md-2 text-center">{{$caja->fecha}}</td>    
            <td class="col-md-2 text-center">{{$caja->user->name}}</td>    
        </tr>
    </tbody>
</table> 
