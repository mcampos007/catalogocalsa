<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Caja;
use App\Puntodeventa;
use App\User;
use App\Efectivo;
use App\Gasto;
use App\Cheque;
use App\Client;
use App\Banco;
use App\Tarjeta;
use App\Otropago;
use App\Tipomovimiento;
use Illuminate\Support\Facades\DB;
use PDF;

class CajaController extends Controller
{
    //LIstado de Cajas
    public function index()
    {
       
       // dd($puntodeventas);
        if (auth()->user()->role == "usuario")
        {
         $cajas = Caja::where('status','Abierta')->where('user_id',auth()->user()->id)->paginate(10);
             
        }
        else
        {
            $cajas = Caja::where('status','Abierta')->paginate(10);
            
        }
        return view('admin.cajas.index')->with(compact('cajas'));
            

    }

    // Lista de Cajas Cerradas
    public function indexcerradas()
    {
        if(auth()->user()->role=="admin")
            $cajas = Caja::where('status','Cerrada')->paginate(10);
        else
            $cajas = Caja::where('status','Cerrada')->where('user_id', auth()->user()->id)->paginate(10);
        return view('admin.cajas.indexcerradas')->with(compact('cajas'));
    }

    //Form para el alta de Caja
    public function create()
    {
        //
        $users = User::all();
        $puntodeventas = Puntodeventa::all();
        //dd($puntodeventas);
        return view('admin.cajas.create')->with(compact('puntodeventas','users'));
    }

    public function store(Request $request)
    {
       //dd($request);
        //validar
        $messages =[
            'puntodeventa_id.required' => "Se debe Seleccionar un Punto de Venta",
            'puntodeventa_id.min' => "Se debe Seleccionar un Punto de Venta",
            'user_id.required' => 'Se debe seleccinar un Usuario',
            'user_id.min' => 'Se debe seleccinar un Usuario',
            'totalplanilla.required'=>'Es necesario ingresar un Importe en la planilla',
            'totalplanilla.numeric' => "Se debe Ingresar un valor numérico."
        ];
        
        //Reglas
        $rules = [
            'puntodeventa_id' => 'required|numeric|min:1',
            'user_id' => 'required|numeric|min:1',
            'totalplanilla' => 'required|numeric'                
        ];

        $this->validate($request,$rules, $messages);


        $caja = new Caja();
        $caja->fecha = $request->input('fecha');
        $caja->puntodeventa_id = $request->input('puntodeventa_id');
        $caja->user_id = $request->input('user_id');
        $caja->totalplanilla = $request->input('totalplanilla');
        $caja->anotaciones = $request->input('anotaciones');
        $caja->status = "Abierta";
        // Verificar que no haya una caja abierta para ese punto de venta
        /*$cajaabierta = DB::table('cajas')->where('status', 'Abierta')
            ->where('puntodeventa_id',$caja->puntodeventa_id)
            ->get();*/
        if(auth()->user()->role="usuario")
        {
            $cajaabierta = Caja::where('status','Abierta')
                ->where('puntodeventa_id',$caja->puntodeventa_id)
                ->where('user_id',auth()->user()->id)     //
               ->count();  
        }else
        {
            $cajaabierta = Caja::where('status','Abierta')
                ->where('puntodeventa_id',$caja->puntodeventa_id)     //
               ->count();  
        }
       
        if ($cajaabierta== 0){
            $caja->save();

        }else{
            $notification = "Existe una caja abierta para ese punto de Venta, NO se puede Registrar una Nueva";
            return redirect('/admin/cajas')->with(compact('notification'));

        }
        return redirect('/admin/cajas');

    }

    //Form para el alta del conteo de billetes
    public function arqueo($id)
    {
        $caja = Caja::find($id);
        
        if (!$caja->efectivo_id){
            return view('admin.cajas.arqueo')->with(compact('caja'));
        }else{
            $efectivo = Efectivo::find($caja->efectivo_id);
            return view('admin.cajas.arqueoedit')->with(compact('efectivo','caja'));
        }
    }

    // Actualización DB con Arqueo
    public function storearqueo(Request $request){
        $messages =[
            'billete1000.required' => "Se debe ingresar la cantidad e billetes de $1000.",
            'billete500.required' => "Se debe ingresar la cantidad e billetes de $500.",
            'billete200.required' => "Se debe ingresar la cantidad e billetes de $200.",
            'billete100.required' => "Se debe ingresar la cantidad e billetes de $100.",
            'billete50.required' => "Se debe ingresar la cantidad e billetes de $50.",
            'billete20.required' => "Se debe ingresar la cantidad e billetes de $20.",
            'billete10.required' => "Se debe ingresar la cantidad e billetes de $10.",
            'billete1000.numeric' => "Solo se permiten Números.",
            'billete500.numeric' => "Solo se permiten Números.",
            'billete200.numeric' => "Solo se permiten Números.",
            'billete100.numeric' => "Solo se permiten Números.",
            'billete50.numeric' => "Solo se permiten Números.",
            'billete20.numeric' => "Solo se permiten Números.",
            'billete10.numeric' => "Solo se permiten Números."
        ]; 
        //Reglas
        $rules = [
            'billete1000' => "required|numeric",
            'billete500' => "required|numeric",
            'billete200' => "required|numeric",
            'billete100' => "required|numeric",
            'billete50' => "required|numeric",
            'billete20' => "required|numeric",
            'billete10' => "required|numeric"                 
        ];

        $this->validate($request,$rules, $messages);

        $caja_id = $request->input('caja_id');
        $caja = Caja::findOrFail($caja_id);
        if (!$caja->efectivo_id){
            $efectivo = new Efectivo();    
            $efectivo->billete1000 = $request->input('billete1000');
            $efectivo->billete500 = $request->input('billete500');
            $efectivo->billete200 = $request->input('billete200');
            $efectivo->billete100 = $request->input('billete100');
            $efectivo->billete50 = $request->input('billete50');
            $efectivo->billete20 = $request->input('billete20');
            $efectivo->billete10 = $request->input('billete10');
            $efectivo->save();
            
            $efectivo_id = Efectivo::latest('id')->first();
            
            DB::table('cajas')
                ->where('id', $caja_id)
                ->update(['efectivo_id' =>$efectivo->id]);
        
        }else{
            $efectivo = Efectivo::find($caja->efectivo_id);
            $efectivo->billete1000 = $request->input('billete1000');
            $efectivo->billete500 = $request->input('billete500');
            $efectivo->billete200 = $request->input('billete200');
            $efectivo->billete100 = $request->input('billete100');
            $efectivo->billete50 = $request->input('billete50');
            $efectivo->billete20 = $request->input('billete20');
            $efectivo->billete10 = $request->input('billete10');
            $efectivo->save();
        }
        
        return redirect('/admin/cajas');        
    }

    //Lista  de Egresos
    public function egreso($id)
    {
        $caja = Caja::find($id);
        
        $gastos = Gasto::where('cajas_id',$caja->id)->paginate(5);
        $totals = Gasto::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.egreso')->with(compact('caja','gastos','t'));
    }

    
    // form para alta de Egreso
    public function egresocreate($id)
    {
        $caja = Caja::find($id);

        return view('admin.cajas.egresocreate')->with(compact('caja'));
    }


    //Registro del Egreso en la BD
    public function storeegreso(Request $request)
    {
        $messages = [
            'detalle.required' => 'Se debe Ingresar un detalle.',
            'detalle.min' => 'El detalle debe contener al menos tres caracteres.',
            'importe.numeric' => 'El importe se debe compleetar con numeros.'
        ];
        $rules = [
            'detalle' => 'required|min:3',
            'importe' => 'required|numeric'
        ];
        $this->validate($request,$rules, $messages);

        $gasto = new Gasto();
        $gasto->detalle = $request->input('detalle');
        $gasto->importe = $request->input('importe');
        $gasto->fecha = $request->input('fecha');
        $gasto->cajas_id = $request->input('caja_id');
        $gasto->save();
        
        $caja = Caja::find($gasto->cajas_id);
        $gastos = Gasto::where('cajas_id',$caja->id)->paginate(5);
        $totals = Gasto::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.egreso')->with(compact('caja','gastos','t'));
    }


    //form para edicion del egreso
    public function editegreso($id)
    {

        $gasto = Gasto::find($id);
        return view('admin.cajas.editegreso')->with(compact('gasto'));
    }

    //actualizacion del egreso en la Bd
    public function egresoupdate(Request $request)
    {
        $id = $request->input('id');
        $gasto = Gasto::find($id);
        $gasto->detalle = $request->input('detalle');
        $gasto->importe = $request->input('importe');
        $gasto->save();
        $caja = Caja::find($gasto->cajas_id);
        $gastos = Gasto::where('cajas_id',$caja->id)->paginate(5);
        $totals = Gasto::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.egreso')->with(compact('caja','gastos','t'));
    }


    //Eliminación del Egreso
    public function egresodestroy($id)
    {
        //

        $gasto = Gasto::find($id);
        $caja_id = $gasto->cajas_id;
        //dd($caja_id);
        $gasto->delete();
        $caja = Caja::find($caja_id);
        $gastos = Gasto::where('cajas_id',$caja_id)->paginate(5);
        $totals = Gasto::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.egreso')->with(compact('caja','gastos','t'));  
    }

        //Lista de Egresos
    public function cheque($id)
    {
        $caja = Caja::find($id);
        
        $cheques = Cheque::where('cajas_id',$caja->id)->paginate(5);
        $totals = Cheque::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.cheque')->with(compact('caja','cheques','t'));
    }

    // form para alta de Cheque
    public function chequecreate($id)
    {
        $caja = Caja::find($id);
        $clients = Client::all();
        $bancos = Banco::All();

        return view('admin.cajas.chequecreate')->with(compact('caja','clients','bancos'));
    }

    //Registro del Cheque en la BD
    public function storecheque(Request $request)
    {
       // dd($request);
        $messages = [
            'detalle.required' => 'Se debe Ingresar un detalle.',
            'detalle.min' => 'El detalle debe contener al menos tres caracteres.',
            'importe.numeric' => 'El importe se debe completar con numeros.',
            'fch_emision.required' => 'Se debe elegir una Fecha',
            'fch_cobr.required' => 'Se debe elegir una Fecha',
            'importe.required' => 'Se debe ingresar el importe del Cheque',
            'importe.numeric' => 'El importe solo debe contener numeros',
            'number.required' => 'Se debe ingresar el número del Cheque',
            'number.numeric' => 'El numero solo debe contener digitos del 0 al 9',
            'client_id.required' => 'Se debe seleccionar un Cliente',
            'client_id.integer' => 'Se debe seleccionar un cliente',
            'client_id.min' => 'Se debe Seleccionar un cliente',
            'banco_id.required' => 'Se debe Selecionar un Banco',

        ];
        
        $rules = [
            'fch_emision' => 'required',
            'fch_cobr' => 'required',
            'importe' => 'required|numeric',
            'number' => 'required|numeric',
            'client_id' => 'required|integer|min:1',
            'banco_id' => 'required'
        ];
        
        $this->validate($request,$rules, $messages);

        $cheque = new Cheque();

        $cheque->fch_emision =  $request->input('fch_emision');
        $cheque->fch_cobr =  $request->input('fch_cobr');
        $cheque->importe =  $request->input('importe');
        $cheque->client_id =  $request->input('client_id');
        $cheque->titular =  $request->input('titular');
        $cheque->banco_id =  $request->input('banco_id');
        $cheque->number =  $request->input('number');
        $cheque->estadocheque_id =  "1";  //$request->input('estadocheque_id');
        $cheque->cajas_id = $request->input('caja_id');

        $cheque->save();
        
        $caja = Caja::find($cheque->cajas_id);
        $cheques = Cheque::where('cajas_id',$caja->id)->paginate(5);
        $totals = Cheque::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.cheque')->with(compact('caja','cheques','t'));
    }

    //form para edicion del cheque
    public function editcheque($id)
    {

        $cheque = Cheque::find($id);
        $clients = Client::all();
        $bancos = Banco::All();
        //dd($cheque);
        return view('admin.cajas.editcheque')->with(compact('cheque','clients','bancos'));
    }


    //actualizacion del Cheque en la Bd
    public function chequeupdate(Request $request)
    {
        $id = $request->input('id');
        $cheque = Cheque::find($id);
        $cheque->fch_emision = $request->input('fch_emision');
        $cheque->fch_cobr =$request->input('fch_cobr');
        $cheque->importe =$request->input('importe');
        $cheque->client_id =$request->input('client_id');
        $cheque->titular =$request->input('titular');
        $cheque->banco_id =$request->input('banco_id');
        $cheque->number =$request->input('number');
        //$cheque->estadocheque_id = $request->input('estadocheque_id');
        //$cheque->cajas_id = $request->input('cajas_id');
        $cheque->save();

        $caja = Caja::find($cheque->cajas_id);
        
        $cheques = Cheque::where('cajas_id',$caja->id)->paginate(5);
        $totals = Cheque::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.cheque')->with(compact('caja','cheques','t'));
    }


    //Eliminación del Egreso
    public function chequedestroy($id)
    {
        //

        $cheque = Cheque::find($id);
        $caja_id = $cheque->cajas_id;
        //dd($caja_id);
        $cheque->delete();
        $caja = Caja::find($cheque->cajas_id);
        
        $cheques = Cheque::where('cajas_id',$caja->id)->paginate(5);
        $totals = Cheque::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.cheque')->with(compact('caja','cheques','t'));
    }

    //Lista de tarjetas
    public function tarjeta($id)
    {
        $caja = Caja::find($id);
        
        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->paginate(5);
        $totals = Tarjeta::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.tarjeta')->with(compact('caja','tarjetas','t'));
    }

     // form para alta de Tarjetas
    public function tarjetacreate($id)
    {
        $caja = Caja::find($id);
       // $clients = Client::all();
        //$bancos = Banco::All();

        return view('admin.cajas.tarjetacreate')->with(compact('caja'));
    }

    //Registro del Cheque en la BD
    public function storetarjeta(Request $request)
    {
       // dd($request);
        $messages = [
            'detalle.required' => 'Se debe ingresar un detalle para el cierre' ,
            'importe.required' => 'Se debe ingresar el importe para  el cierre' ,
            'terminal_number.required' => 'Se debe ingresar el número de Terminal' ,
            'lote_number.required' => 'Se debe el número de cierre de lote.' 
        ];
        
        $rules = [
            'detalle' => 'required' ,
            'importe' => 'required' ,
            'terminal_number' => 'required' ,
            'lote_number' => 'required' 
        ];
        
        $this->validate($request,$rules, $messages);

        $tarjeta = new Tarjeta();

        $tarjeta->detalle =  $request->input('detalle');
        $tarjeta->importe =  $request->input('importe');
        $tarjeta->cajas_id =  $request->input('caja_id');
        $tarjeta->terminal_number =  $request->input('terminal_number');
        $tarjeta->lote_number =  $request->input('lote_number');

        $tarjeta->save();
        
        $caja = Caja::find($tarjeta->cajas_id);
        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->paginate(5);
        $totals = Tarjeta::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.tarjeta')->with(compact('caja','tarjetas','t'));
    }

    //form para edicion del cheque
    public function edittarjeta($id)
    {

        $tarjeta = Tarjeta::find($id);
        /*$clients = Client::all();
        $bancos = Banco::All();*/
        //dd($cheque);
        return view('admin.cajas.edittarjeta')->with(compact('tarjeta'));
    }


    //actualizacion del Cheque en la Bd
    public function tarjetaupdate(Request $request)
    {
        $id = $request->input('id');
        $tarjeta = Tarjeta::find($id);
        $tarjeta->detalle = $request->input('detalle');
        $tarjeta->importe =$request->input('importe');
        $tarjeta->terminal_number =$request->input('terminal_number');
        $tarjeta->lote_number =$request->input('lote_number');
        
        $tarjeta->save();

        $caja = Caja::find($tarjeta->cajas_id);
        
        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->paginate(5);
        $totals = Tarjeta::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.tarjeta')->with(compact('caja','tarjetas','t'));
    }

    //Eliminación del Egreso
    public function tarjetadestroy($id)
    {
        //

        $tarjeta = Tarjeta::find($id);
        $caja_id = $tarjeta->cajas_id;
        //dd($caja_id);
        $tarjeta->delete();
        $caja = Caja::find($tarjeta->cajas_id);
        
        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->paginate(5);
        $totals = Tarjeta::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.tarjeta')->with(compact('caja','tarjetas','t'));
    }

    //Lista de Otrosfp
    public function otrafp($id)
    {
        $caja = Caja::find($id);
        
        $otropagos = Otropago::where('cajas_id',$caja->id)->paginate(5);
        $totals = Otropago::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($otropagos);
        return view('admin.cajas.otropago')->with(compact('caja','otropagos','t'));
    }

     // form para alta de Otrosfp
    public function otrafpcreate($id)
    {
        $caja = Caja::find($id);
        $clients = Client::all();
        $tipomovimientos = Tipomovimiento::all();
        //$bancos = Banco::All();

        return view('admin.cajas.otropagocreate')->with(compact('caja','clients','tipomovimientos'));
    }

    //Registro del Otropago en la BD
    public function storeotrafp(Request $request)
    {
       // dd($request);
        $messages = [
            'client_id.required' => 'Se debe Ingresar un cliente',
            'tipomovimiento_id.required' => 'Se debe Ingresar el tipo de movimiento',
            'detalle.required' => 'Se debe Ingresar un detalle',
            'importe.required' => 'Se debe Ingresar el importe' 
        ];
        
        $rules = [
            'client_id' => 'required',
            'tipomovimiento_id' => 'required',
            'detalle' => 'required',
            'importe' => 'required' 
        ];
        
        $this->validate($request,$rules, $messages);

        $otropago = new Otropago();

        $otropago->cajas_id = $request->input('caja_id') ;
        $otropago->client_id = $request->input('client_id');
        $otropago->tipomovimiento_id = $request->input('tipomovimiento_id');
        $otropago->detalle = $request->input('detalle');
        $otropago->importe = $request->input('importe');
        $otropago->fecha = $request->input('fecha');

        $otropago->save();
        
        $caja = Caja::find($otropago->cajas_id);
        $otropagos = Otropago::where('cajas_id',$caja->id)->paginate(5);
        $totals = Otropago::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.otropago')->with(compact('caja','otropagos','t'));
    }

    //form para edicion del otro pago
    public function editotrafp($id)
    {

        $otropago = Otropago::find($id);
        $clients = Client::all();
        $tipomovimientos = Tipomovimiento::All();
        /*$bancos = Banco::All();*/
        //dd($cheque);
        return view('admin.cajas.editotropago')->with(compact('otropago','clients','tipomovimientos'));
    }

    //actualizacion del otro fp en la Bd
    public function otrafpupdate(Request $request)
    {
        $id = $request->input('id');
        $otropago = Otropago::find($id);
        $otropago->detalle = $request->input('detalle');
        $otropago->importe =$request->input('importe');
        $otropago->fecha =$request->input('fecha');
        $otropago->tipomovimiento_id =$request->input('tipomovimiento_id');
        $otropago->client_id =$request->input('client_id');
        
        $otropago->save();

        $caja = Caja::find($otropago->cajas_id);
        
        $otropagos = Otropago::where('cajas_id',$caja->id)->paginate(5);
        $totals = Otropago::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.otropago')->with(compact('caja','otropagos','t'));
    }

    //Eliminación del Egreso
    public function otrafpdestroy($id)
    {
        //

        $otropago = Otropago::find($id);
        $caja_id = $otropago->cajas_id;
        //dd($caja_id);
        $otropago->delete();
        $caja = Caja::find($caja_id);
        
        $otropagos = Otropago::where('cajas_id',$caja->id)->paginate(5);
        $totals = Otropago::where('cajas_id', $caja->id)->get();
        $t = 0;
        foreach($totals as $total){
            $t = $t +$total->importe;
        }
        //dd($t);
        return view('admin.cajas.otropago')->with(compact('caja','otropagos','t'));
    }

    // Form de Cierre de Caja
    public function formcerrar($id){
        $caja = Caja::find($id);
        
        $gastos = Gasto::where('cajas_id',$caja->id)->get();
        $sumgasto = 0;
        foreach($gastos as $g){
            $sumgasto += $g->importe;
        }

        $otrosfp = Otropago::where('cajas_id',$caja->id)->get();
        $sumotrosfp = 0;
        foreach($otrosfp as $g){
            $sumotrosfp += $g->importe;
        }

        $cheques = Cheque::where('cajas_id',$caja->id)->get();
        $sumcheques = 0;
        foreach($cheques as $g){
            $sumcheques += $g->importe;
        }

        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->get();
        $sumtarjetas = 0;
        foreach($tarjetas as $g){
            $sumtarjetas += $g->importe;
        }
        // dd($tarjetas);
        //dd($sumgasto);
        $totbillete = 0.00;
        $totbillete += $caja->efectivo->billete1000 * 1000;
        $totbillete += $caja->efectivo->billete500 * 500;
        $totbillete += $caja->efectivo->billete200 * 200;
        $totbillete += $caja->efectivo->billete100 * 100;
        $totbillete += $caja->efectivo->billete50 * 50;
        $totbillete += $caja->efectivo->billete20 * 20;
        $totbillete += $caja->efectivo->billete10 * 10;
       // dd($caja->gastos());
        return view('admin.cajas.cerrar')->with(compact(
            'caja','totbillete',
            'gastos','sumgasto',
            'otrosfp','sumotrosfp',
            'cheques','sumcheques',
            'tarjetas','sumtarjetas'
            ));

    }
    // Cierre de Caja en la BD
    public function cerrar(Request $request){
        $id = $request->input('id');

        $caja = Caja::find($id);
        $caja->status = "Cerrada";
        $caja->save();
        if(auth()->user()->role=="admin")
            return redirect('/admin/cajas');
        else
            return redirect('/usuario/cajas');

    }
    // Imprimir Caja Cerrada
    public function imprimir(Request $request){
       $id = $request->input("caja_id");
        $caja = Caja::find($id);
        
        $gastos = Gasto::where('cajas_id',$caja->id)->get();
        $sumgasto = 0;
        foreach($gastos as $g){
            $sumgasto += $g->importe;
        }

        $otrosfp = Otropago::where('cajas_id',$caja->id)->get();
        $sumotrosfp = 0;
        foreach($otrosfp as $g){
            $sumotrosfp += $g->importe;
        }

        $cheques = Cheque::where('cajas_id',$caja->id)->get();
        $sumcheques = 0;
        foreach($cheques as $g){
            $sumcheques += $g->importe;
        }

        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->get();
        $sumtarjetas = 0;
        foreach($tarjetas as $g){
            $sumtarjetas += $g->importe;
        }
        // dd($tarjetas);
        //dd($sumgasto);
        $totbillete = 0.00;
        $totbillete += $caja->efectivo->billete1000 * 1000;
        $totbillete += $caja->efectivo->billete500 * 500;
        $totbillete += $caja->efectivo->billete200 * 200;
        $totbillete += $caja->efectivo->billete100 * 100;
        $totbillete += $caja->efectivo->billete50 * 50;
        $totbillete += $caja->efectivo->billete20 * 20;
        $totbillete += $caja->efectivo->billete10 * 10;
       // dd($caja->gastos());
        return view('admin.cajas.imprime')->with(compact(
            'caja','totbillete',
            'gastos','sumgasto',
            'otrosfp','sumotrosfp',
            'cheques','sumcheques',
            'tarjetas','sumtarjetas'
            ));

    }
    
    public function generatePDF(Request $request)
    {
        //dd($request);
        $id = $request->input("id");
        
        //$data = $data+ ['id' => $id];
        //dd($data1);
         
        $caja = Caja::find($id);
        $efectivo = Efectivo::find($caja->id);
        $totbillete = 0.00;
        $totbillete += $caja->efectivo->billete1000 * 1000;
        $totbillete += $caja->efectivo->billete500 * 500;
        $totbillete += $caja->efectivo->billete200 * 200;
        $totbillete += $caja->efectivo->billete100 * 100;
        $totbillete += $caja->efectivo->billete50 * 50;
        $totbillete += $caja->efectivo->billete20 * 20;
        $totbillete += $caja->efectivo->billete10 * 10;
        //TArjetas
        $tarjetas = Tarjeta::where('cajas_id',$caja->id)->get();
        $sumtarjetas = 0;
        foreach($tarjetas as $g){
            $sumtarjetas += $g->importe;
        }
        // Otros FP
        $otrosfp = Otropago::where('cajas_id',$caja->id)->get();
        $sumotrosfp = 0;
        foreach($otrosfp as $g){
            $sumotrosfp += $g->importe;
        }
        //Gastos
        $gastos = Gasto::where('cajas_id',$caja->id)->get();
        $sumgasto = 0;
        foreach($gastos as $g){
            $sumgasto += $g->importe;
        }
        //Cheques
        $cheques = Cheque::where('cajas_id',$caja->id)->get();
        $sumcheques = 0;
        foreach($cheques as $g){
            $sumcheques += $g->importe;
        }

        view()->share('cajaPDF',
            $caja, 
            $efectivo, 
            $tarjetas, 
            $sumtarjetas,
            $totbillete,
            $otrosfp,
            $sumotrosfp,
            $cheques,
            $sumcheques,
            $gastos,
            $sumgasto

        );
        $pdf = PDF::loadView('cajapdf', [
            'caja' => $caja, 
            'efectivo'=>$efectivo,
            'tarjetas' =>$tarjetas,
            'sumtarjetas' => $sumtarjetas,
            'totbillete' => $totbillete,
            'otrosfp' => $otrosfp,
            'sumotrosfp' => $sumotrosfp,
            'cheques' => $cheques,
            'sumcheques' => $sumcheques,
            'gastos' => $gastos,
            'sumgasto' => $sumgasto
        ]);

        //$pdf = PDF::loadView('cajapdf', $data, compact('caja', 'tarjetas'));
        //$pdf->setPaper('A4', 'landscape');
  
        return $pdf->download('cajadiaria.pdf');
    }
    
}
