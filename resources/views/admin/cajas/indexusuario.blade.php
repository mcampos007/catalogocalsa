@if($caja->status == 'Abierta')
    <a href="{{ url('/usuario/cajas/'.$caja->id.'/arqueo')}}" type="button" rel="tooltip" title="Arqueo" class="btn btn-info btn-simple btn-xs ">
    <i class="bi bi-cash-coin"></i>
    </a>
    <a href="{{ url('/usuario/cajas/'.$caja->id.'/egreso')}}" type="button" rel="tooltip" title="Egresos" class="btn btn-info btn-simple btn-xs">
    <i class="bi bi-currency-dollar"></i>
    </a>
    <a href="{{ url('/usuario/cajas/'.$caja->id.'/cheque')}}" type="button" rel="tooltip" title="Cheques" class="btn btn-info btn-simple btn-xs">
    <i class="bi bi-currency-exchange"></i>
    </a>
    <a href="{{ url('/usuario/cajas/'.$caja->id.'/tarjeta')}}" type="button" rel="tooltip" title="Tarjetas" class="btn btn-info btn-simple btn-xs">
    <i class="fa fa-info"></i>
    </a>
    <a href="{{ url('/usuario/cajas/'.$caja->id.'/otrafp')}}" type="button" rel="tooltip" title="Otros MP" class="btn btn-info btn-simple btn-xs">
    <i class="fa fa-calendar-check-o"></i>
    </a>
    <a href=" {{ url('/usuario/cajas/'.$caja->id.'/cerrar')}}" type="button" rel="tooltip" title="Cerrar" class="btn btn-success btn-simple btn-xs">
    <i class="fa fa-edit"></i>
    </a>
    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
    <i class="fa fa-times"></i>
</button>
@endif