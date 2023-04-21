<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Cart;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::paginate(10);
        return view('admin.clients.index')->with(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para cliente',
            'name.min' => "el cliente debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $client = new Client();
        $client->name = $request->input('name');
        $client->direccion = $request->input('direccion');
        $client->email = $request->input('email');
        $client->cuit = $request->input('cuit');
        $client->save();
        return redirect('/admin/clients');
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
        //
        $client = Client::find($id);
        return view('admin.clients.edit')->with(compact('client'));
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
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para el cliente',
            'name.min' => "el cliente debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $client = Client::find($id);
        $client->name = $request->input('name');
        $client->direccion = $request->input('direccion');
        $client->email = $request->input('email');

        
        $client->save();
        
        return redirect('/admin/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cart = Cart::where('client_id',$id)->get();
          $cant = $cart->count();
          //echo $cant;
          
        //dd($product);
          if ($cant===0){
                $client = Client::find($id);
                $client->delete();   
                return back(); 
          }else{
            return back()->with('msj','No se puede eliminar un cliente con Remitos asociados');    
          }
    }

}
