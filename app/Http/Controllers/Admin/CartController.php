<?php

namespace App\Http\Controllers\Admin;
use App\Exports\RemitoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF; 
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;
use App\CartDetail;
use App\Invoice;
use App\InvoiceDetail;
use App\Sucursal;
use App\Category;
use App\promotion;
class CartController extends Controller
{
    // Ver Pedido/Remito
    public function vercart($id)
    {
        //

        $remito = Cart::find($id);
        $sucursales = Sucursal::all();
        $notification = [];
        return view('admin.remitos.index')->with(compact('remito','sucursales','notification'));
        
    }

    //FActurar Remito
    public function facturarremito($id)
    {
        $remito = Cart::find($id);
        //dd($remito);
        return view('admin.remitos.facturar')->with(compact('remito'));
        
    }

    public function excel($id)
    {
        return Excel::download(new RemitoExport, 'remito.xlsx', $id);
    }

    public function edit($id)
    {
        $remito = Cart::find($id);
        $sucursales = Sucursal::all();
        return view('admin.remitos.index')->with(compact('remito','sucursales'));
    }

    public function remitopdf($id)
    {
        $today = Carbon::now()->format('d-m-Y');
        $remito = Cart::find($id);
        $detalle = $remito->details;
      //  dd($remito->client_Name);
       //dd($remito->details);
        $pdf = PDF::loadView('admin.remitos.remito',compact('remito','detalle'));
        //return $pdf->download();
        return $pdf->stream();
    }

    //Pasaje de Remito a FActura
    public function update(Request $request)
    {
        //
        
        $remito_id = $request->input('remito_id');

        
        // Traer el Remito y pasar a Factura.
        $cart = Cart::find($remito_id);
        
        //Canbiar el estado del Remito  a Invoiced
        $cart->status ="Approved";
        $cart->save();
                
        $notification = "El pedido se ha pasado a facturación";

        $remito = Cart::find($remito_id);
        
        return redirect('/home')->with(compact('notification'));
    }


    // eliminar un pedido
    public function destroy(Request $request)
    {
       // dd($request->toArray());
        
        $cart = Cart::findOrfail($request->input('id'));
       //dd($cart);
        if ($cart->status == 'Approved')
        {
            //Se puede eliminar
            //Eliminar los detalles
            $cartDetails = CartDetail::where('cart_id',$cart->id)->get();
            //dd($cartDetails);
            foreach($cartDetails as $cartdetail)
            {
                $detalle = CartDetail::findOrfail($cartdetail->id);
                $detalle->delete();
            }
            
            //Eliminar el Pedido
            $cart->delete();

            $notification = "El pedido $cart->id se eliminó correctamente.";
            
        }
        elseif($cart->status == 'Pending')
        {
            $notification = "Ud. no se puede eliminar un pedido pendiente!!!.";
        }
        //dd($notification);
        $sucursales = Sucursal::all();
        $remitos = Cart::paginate(5);
        return redirect('/home')->with(compact('sucursales','remitos','notification'));
        //return back()->with(compact('notification'));
        //dd($notification);

        //return redirect('home')->with(compact('clients','remitos','sucursales','notification'));  
    }

    //Agregar Item a un pedido
    public function additem($id)
    {
        $cart = Cart::findOrfail($id);
        $categories = Category::has('products')->orderBy('name')->get();
        $promotions = Promotion::paginate(6);
        //Crear una variable sesion con el peido
        session(['remito_id' => $cart->id]);
      
        return view('admin.remitos.additem')->with(compact('categories','promotions','cart'));
    }
}
