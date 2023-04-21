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

class CartController extends Controller
{
    //
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
        return view('admin.remitos.index')->with(compact('remito'));
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
        
        // Por ahora solo cambio el estado del pedido
        // $invoice = new Invoice();
        
        // $invoice->client_id = $cart->client_id;
        // $invoice->status = 'Pending';
        // $invoice->invoice_date = Carbon::now();
        // $invoice->user_id = auth()->user()->id ;
        // $invoice->cart_id = $cart->id;
        // $invoice->total = $cart->total;
        // $invoice->acuenta = 0;
        // $invoice->save();

        // Traer los detalles del remito y pasar a Detalle de Factura
        
        
        // foreach ($cart->details as $detail)
        // {
        //     $detainvoice = new InvoiceDetail();
        //     $detainvoice->invoice_id = $invoice->id;
        //     $detainvoice->product_id = $detail->product_id;
        //     $detainvoice->quantity = $detail->quantity;
        //     $detainvoice->price = $detail->price;
        //     $detainvoice->save();
        // }
        
        //Canbiar el estado del Remito  a Invoiced
        $cart->status ="Approved";
        $cart->save();
         
         //$admins = User::where('admin',true)->get()->pluck('email');
         //mail::to($admins)->send(new NewOrder($client, $cart));
         
         $notification = [];
         $notification['type']='Success';
         $notification['msg']='El pedido  ya fué Confirmado';

        
        $remito = Cart::find($remito_id);
        return view('admin.remitos.index')->with(compact('remito','notification'));
    }

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
}
