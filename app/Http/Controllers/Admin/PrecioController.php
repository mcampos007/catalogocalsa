<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Precio;
use App\Category;
use App\Sector;
use App\User;
use App\Sucursal;
use App\Cart;
use App\CartDetail;

class PrecioController extends Controller
{
    //
    public function index(Request $request){
        $texto = trim($request->input('texto'));
        //dd($texto);
        $recargo = auth()->user()->recargo;
        $products = DB::table('products')
            ->select('id','name','price','nro_art','topedesc','con_descuento')
            ->where('name','LIKE','%'.$texto.'%')
            ->where('sector_id','=','1')
            ->orderBy('name','asc')
            ->paginate(5);
            //dd($products);
        $sucursales = Sucursal::all();
        //dd($sucursales);
       return view('admin.precios.precios')->with(compact('products','texto','recargo','sucursales'));
    }


    public function indexf(Request $request){
        $texto = trim($request->input('texto'));
        //dd($texto);
        $recargo = 1; //auth()->user()->recargo;
        $products = DB::table('products')
            ->select('id','name','price','nro_art','topedesc','con_descuento')
            ->where('name','LIKE','%'.$texto.'%')
            ->where('sector_id','=','2')
            ->orderBy('name','asc')
            ->paginate(5);

       return view('admin.precios.preciosf')->with(compact('products','texto','recargo'));
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
       
        return view('search.productosfiltrados')->with(compact('products','query'));

    }

    public function agregaitem(Request $request, $id)
    {

        //REcuperar los articulos
        $articulo = Product::findOrfail($id);
        return view('usuarios.create',compact('articulo'));
      //  dd($articulo->toArray());
        
    }

    public function store(Request $request)
    {
        //dd($request->toArray());
        // Determinar si hay un pedido pendiente para el usuario
        $client = auth()->user() ;// El usuario Activo
        
        $cart = Cart::where('user_id',$client->id)->where('status','Active')->take(1)->get();
       // dd($cart);
        
       // dd($request);
        if (count($cart) > '0') ///
        {
             // Solo Agregar el item al detalle 
        }
        else 
        {
            // Crear el Cart y agregar el detalle
            $cart = New Cart();
            $cart->status = 'Active';
            $cart->user_id = auth()->user();
            $cart->save();

            $cart = Cart::where('user_id',$client->id)->take(1)->get();

        }

        // Solo Agregar el item al detalle
        foreach($cart as $c)
            {
                $cartDetail = new CartDetail();
                $cartDetail->cart_id = $c->id;
                $cartDetail->product_id = $request->input('product_id');
                $cartDetail->quantity = $request->input('quantity');
                $cartDetail->stocklocal = $request->input('stockactual');
                $cartDetail->save();
            }

        return redirect('/usuario/precios');
    }

    public function editaitem($id)
    {
        //REcuperar los articulos

        $cartdetail = CartDetail::findOrfail($id);
       // dd($articulo);
        return view('usuarios.edit',compact('cartdetail'));
    }

    public function update(Request $request)
    {
        // 
        //dd($request);
        $id = $request->input('cartdetail_id');
        //dd($id);
        $cartDetail = CartDetail::findOrfail($id);
        //dd($cartDetail);
        if ($cartDetail)
        {
            $cartDetail->quantity = $request->input('quantity');
            $cartDetail->stocklocal = $request->input('stockactual');
            $cartDetail->save();
            
            $notification = 'El Item se ha actualizado correctamente..';
            

            return redirect('/home')->with(compact('notification'));

        }
        
    }

    public function destroy(Request $request)
    {
        //dd($request->toArray());
        $cart = Cart::findOrfail($request->input('id'));
        //dd($cart);
        if ($cart->status == 'Pending')
        {
            //Se puede eliminar
            //Eliminar Items si hubieran
            $id = $cart->id;
            $items = CartDetail::where('cart_id',$id)->get();
            //dd($items->toArray());
            if (count($items)>0)
            {
                foreach($items as $item)
                {
                    $deleteitem = CartDetail::find($item->id);
                    $deleteitem->delete();
                }
            }
            $cart->delete();
            $notification = "El Pedido se ha eliminado satisfactoriamente!";

        }
        else
        {
            $notification = "No se puede eliminar el pedido solicitado!";           
        }
        //dd($notification);
        return back()->with(compact('notification'));
        //dd($notification);

        //return redirect('home')->with(compact('clients','remitos','sucursales','notification'));
        
         
    }
   
    //Visualizar un pedido
    public function verremito($id)
    {
        //

        $remito = Cart::find($id);
        $sucursales = Sucursal::all();
        //$notification = [];
        return view('admin.remitos.index')->with(compact('remito','sucursales'));
        
    }
}
