<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
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
            // Verificar si el nombre del artículo comienza con "ZZ"

            if (!$articulo->eliminado){
                $is_deleted = preg_match('/^ZZ{2,}/', $articulo->articulo);

                IF ($articulo->id==7384){
                    dd($articulo->id);
                }
                /*if (Str::startsWith($articulo->articulo, 'ZZ')) {
                    dd($articulo->articulo);
                   $is_deleted = true;
                }  */  
            }else{

                $is_deleted = $articulo->eliminado;
            }

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
        $notification = "Lista de Precios actualizada";
        return redirect("/")->with('notification', $notification);
        //return view('home')->with(compact('clients','remitos','sucursales','notification', 'clifacs'));
    }
}




            