<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;
use App\Cart;
use App\Product;
use App\CartDetail;
use App\client;
use App\Sucursal;
use DB;
//use App\CartDetail;
class CartController extends Controller
{
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
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Request $request)
    {
        //
        
        //dd($request); 
        //Crear Objeto a la BD del Sistema de Gestión
        $clifac = DB::connection('mysql2')->table('clientes')->find($request->input('cliente_id'));
       //dd($clifac);
        //Verificar si existe el cliente para tomar su Id, o darlo de alta
        $client = Client::find($clifac->id);
        
        if ($client)
        {
            //Actualizar datos
            $client->name = $clifac->cliente; 
            $client->direccion = $clifac->direccion;
            $client->email = $clifac->email;
            $client->cuit = $clifac->cuit;
            $client->save(); 
        }else{
            //Dar de alta
            $client = new Client;
            
            $client->id = $clifac->id;
            $client->name = $clifac->cliente; 
            $client->direccion = $clifac->direccion;
            $client->email = $clifac->email;
            $client->cuit = $clifac->cuit;
            $client->save(); 
        }


        ///
        $cart = Cart::find($request->input('pedido_id'));
        //dd($clifac);
         $client = auth()->user() ;
         $cart = $client->cart;
         $cart->status = 'Pending';
         $cart->client_id = $request->input('cliente_id');
         $cart->order_date = Carbon::now();
         $cart->observ = $request->input('observ').'/**'.$cart->id.'**/';
        // $cart->sucursal_id = $request->input('sucursal_id');
        // foreach ($cart->details as $item){
           //  echo $item->id."----". $item->product_id;
         //    $product = Product::find($item->product_id);
         //    $detalle = CartDetail::find($item->id);
            // echo "....".$product->price;
            // echo "</br>";
           //  $detalle->price = $product->price;
            // $detalle->save(); 
         //}

        $cart->save();  // el pedido se pasa a Pendiente para facturación

        // Preparar los datos para guardar el pedido en el sistema de gestión
        $idcliente = $clifac->id;
        $cliente = $clifac->cliente;
        $fecha_p = Carbon::now();
        $fecha_e = Carbon::now();
        $estado = "1";
        $idvendedor = $clifac->idvendedor;
        $observ = $request->input('observ').'/**'.$cart->id.'**/';
        $forpago = "1";
        $fchalta = Carbon::now();;
        $idautoriza = null;
        $nomautoriza = null;
        $bloqueo = "0";
        $pedidoweb_id = DB::connection('mysql2')->table('pedidosweb')->insertGetId(
            [   'idcliente'  => $idcliente , 
                'cliente'  => $cliente ,
                'fecha_p' =>  $fecha_p,
                'fecha_e' =>  $fecha_e,
                'estado' =>  $estado,
                'idvendedor' =>  $idvendedor,
                'observ' =>  $observ,
                'forpago' =>  $forpago,
                'fchalta' =>  $fchalta,
                'idautoriza' =>  $idautoriza,
                'nomautoriza' =>  $nomautoriza,
                'bloqueo'  => $bloqueo 
            ]
        );  // REgistro de la cabecera del pedido

        // Registrar el  detalle del pedido
        //_id = Null
        $detalles = $cart->details;
        foreach ($cart->details as $item){
            $idarticulo = $item->product_id;
            $cantidad = $item->quantity;
            $piezas =  '0';
            $venta_neto = $item->price - $item->price*$item->discount/100;

            if ($venta_neto > 0)
            {
                $detaweb = DB::connection('mysql2')->table('detapedidosweb')->insert(
                [   'id' => null,
                    'idpedido' => $pedidoweb_id,
                    'idarticulo' => $idarticulo,
                    'cantidad' => $cantidad,
                    'piezas' => $piezas,
                    'venta_neto' => $venta_neto,
                    'estado' => "1"
                ]

                ); //REgsitro del detalle del pedido
            }
        }
        
         
         // $notification = "Tu Pedido ya fué confirmado y en Breve nos pondremos en contacto";
         // $typenotif = 'Sucees';

         // $clients = Client::All();
         // $remitos = Cart::All();

         // $sucursales = Sucursal::all();
      
        //$comments = Post::find(1)->comments()->where('title', '=', 'foo')->first();
        //return view('home')->with(compact('clients','remitos'));
       // return redirect('/home')->with(compact('clients','remitos','sucursales','notification','typenotif'));   
        return redirect('/home');
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
    }

    
}
