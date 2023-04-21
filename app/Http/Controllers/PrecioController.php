<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Precio;
use App\Category;
use App\Sucursal;

class PrecioController extends Controller
{
    //
    public function index(Request $request){
        
        $texto = trim($request->input('texto'));
        
        $usuario_id = auth()->user()->id;
        $recargo = auth()->user()->recargo;
        
        if ($usuario_id > 0){
            $recargo = auth()->user()->recargo;
            $products = DB::table('products')
                ->select('id','name','price','nro_art','topedesc','con_descuento')
                ->where('name','LIKE','%'.$texto.'%')
                ->where('sector_id','1')
                ->orderBy('name','asc')
                ->paginate(5);
           $sucursales = Sucursal::all();
            //dd($sucursales);
       //return view('precios')->with(compact('products','texto'));
        //return view('admin.precios.precios')->with(compact('products','texto','recargo'));
            return view('admin.precios.precios')->with(compact('products','texto','recargo','sucursales'));
        }else{
            return redirect('/home');
        }


        
    }

    public function indexf(Request $request){
        $texto = trim($request->input('texto'));
        //dd($texto);
        $recargo = 1 ; //auth()->user()->recargo;
        $products = DB::table('products')
            ->select('id','name','price','nro_art','topedesc','con_descuento')
            ->where('name','LIKE','%'.$texto.'%')
            ->where('sector_id','2')
            ->orderBy('name','asc')
            ->paginate(5);

       //return view('precios')->with(compact('products','texto'));
        return view('admin.precios.preciosf')->with(compact('products','texto', 'recargo'));
    }

    public function data()
    {
        $products = Product::pluck('name');
        return $products;
    }

    public function show(Request $request)
    {
        //

       $query = $request->input('query');        

        if(isset($query)){
           $products = Product::where('name','like',"%$query%")->paginate(5);
        }
        else{

            $products = Product::paginate(5);
           
        }
       
        return view('search.showprices')->with(compact('products','query'));

    }


}
