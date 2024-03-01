<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Product;
use App\Category;
use App\Rubro;
use Carbon\Carbon;

class PriceController extends Controller
{
    //
    public function updatecalsaprice(Request $request){


        $articulos = Articulo::where('articulo', 'NOT LIKE', 'ZZZ%')
                     ->get();

        // Recuperar todos los registros de Articulos y de rubros
        //$articulos = Articulo::all();
        $rubros = Rubro::all();
        foreach ($rubros as $rubro){
            // Obtener la fecha y hora actual
            $now = Carbon::now();
            Category::updateOrInsert(
                ['id' => $rubro->id], // Clave única en la tabla Category
                [
                    'name' => $rubro->rubro,
                    'sector_id' => 1,
                    'rubro_id' =>$rubro->id,
                    'created_at' =>$now,
                    'updated_at' =>$now

                ]
            );
        }

        foreach ($articulos as $articulo) {
            $now = Carbon::now();
            // Calcular el precio basado en la lógica especificada
            $price = $articulo->idiva == 1 ? $articulo->venta_neto * 1.21 : $articulo->venta_neto * 1.105;
            $pricewithdiscont = $price - $price*$articulo->topedesc/100;
            $is_deleted = $articulo->eliminado;

            Product::updateOrInsert(
                ['id' => $articulo->id], // Clave única en la tabla Articulos
                [
                    'name' => $articulo->articulo,
                    'description' => $articulo->articulo,
                    'long_description' => $articulo->articulo,
                    'price' => $price,
                    'topedesc' => $articulo->topedesc,
                    'nro_art' => $articulo->nro_art,
                    'stkdisponible' => 0,
                    'con_descuento' => $pricewithdiscont,
                    'category_id' => $articulo->idrubro,
                    'sector_id' => 1,
                    'is_deleted' => $is_deleted
                    

                ]
            );
            //dd($articulo->id);

        }
        
        //dd($articulos);
        return redirect("/");
        //return view('home')->with(compact('clients','remitos','sucursales','notification', 'clifacs'));
    }
}




            