<style type="text/css">
    table {
   width: 100%;
   border: 1px solid #000;
    }

    caption {
    padding: 0.3em;
    color: #fff;
    background: #000;
    }
    thead {
    background: #eee;
    }
    .izquierda:{
    text-align: left; 
    }

    .derecha {
    text-align: right; 
    }

    .centrado {
    text-align: center; 
    }

    .total {
    background: #eee;
    }

</style>

<div>
<table>
    <thead>
        <tr>
            <td class="izquierda">Remito N°  {{ $remito->id }} </td>
            <td class="derecha">Fecha {{ date('d-m-Y',strtotime($remito->order_date)) }} </td>
        </tr>
    </thead>

    <tr colspan="2">
        <td class="izquierda">
        Sucursal: {{ $remito->sucursal->name }} 
        </td>
    </tr>        
</table>
</div>

<div>
<table>
    <thead>
        <tr>
            <td class="centrado">Codigo</td> <td class="centrado">Artículo</td> <td class="centrado">Precio</td> <td class="centrado">Cantidad </td> <td class="centrado">Importe</td>
        </tr>
    </thead>
   
    @foreach($detalle as $item)
    <tr>
        <td> {{ $item->product->nro_art }}</td>
        <td class="izquierda"> {{ $item->product->name }}</td>
        <td class="derecha"> </td>
        <td class="derecha"> {{ $item->quantity }}</td>
        <td class="derecha"> </td>
    
    </tr>
  
    @endforeach        
   
</table>

</div>

<div class="total">
<table>
    <tr colspan="4">
            <td class="derecha" width="70%">Total</td>
            <td class="derecha"> </td>
    
    </tr>
  
    
</table>

</div>


