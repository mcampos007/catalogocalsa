<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;
use App\Cart;


class CartDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= [
            'quantity' => 'required|min:0.1',
            'descuento' => 'numeric|max:'.$request->topedesc,
        ];
          $messages=[
            'quantity.required' => 'Es necesario ingresar la cantidad solicitad',
            'quantity.numeric' => 'Se debe ingresar un número',
            'quantity.min' => 'La cantidad debe ser mayo que cero',
            'descuento.numeric' =>'El dato ingresado deber ser numérico',
            'descuento.max' => 'El descuento no es permitido',
        ];
        
        $this->validate($request, $rules,$messages);

        $cartDetail = new CartDetail();
        if (session()->has('remito_id')) {
            // La variable de sesión existe
            $cartDetail->cart_id = session('remito_id');  
            session()->forget('remito_id'); //Se elimina la variable session
        }else
        {
            $cartDetail->cart_id = auth()->user()->cart->id; 
        }  
        
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->price = $request->price;
        $cartDetail->discount = $request->descuento;
        $cartDetail->save(); 

        $notification = 'El item se agregó a tu Pedido!!';

        return back()->with(compact('notification'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recueperar los datos a modificar
        $cart = Cart::findOrfail($id);
        $notification = 'Realizar las modificaciones necesarias al pedido';

        return view('admin.pedidos.edit')->with(compact('cart','notification'));
        
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //dd($request->toArray());
        $cartDetail = CartDetail::find($request->cart_detail_id);
        if ($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete();
    
        $notification = "El item se ha eliminado correctamente.";
        
        return back()->with(compact('notification'));
    }
}

