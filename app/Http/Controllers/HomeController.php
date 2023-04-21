<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Cart;
use App\Sucursal;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $notification = [];
      $clients = Client::All();
      $client = auth()->user();
      //dd($client);
      $clifacs = DB::connection('mysql2')->table('clientes')->orderBy('cliente')->get();
      //dd($clifac);
      if ($client->role == "admin")
      {
        $remitos = Cart::paginate(5);
      }
      else
      {
        $remitos = Cart::where('user_id',$client->id)->get();
      }
          
      $sucursales = Sucursal::All();
    
      return view('home')->with(compact('clients','remitos','sucursales','notification', 'clifacs'));
     }
}