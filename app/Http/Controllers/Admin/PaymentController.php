<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Client;
use App\Invoice;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $clients = Invoice::where('acuenta','<>',0)->get();
        dd($clients);

        //$clients = client::paginate(10);
        $saldos = DB::select('select i.client_id, c.name, sum(i.total - i.acuenta) as saldo  from invoices i left join clients c on i.client_id= c.id where i.total > i.acuenta group by client_id')->paginate(10);
        //dd($saldos);
        return view('admin.payments.index')->with(compact('saldos'));
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

        $input = $request->all();
       // dd($input);
        $client_id = $input['client_id'];
        foreach ($input['fact'] as $key => $fact_id){
            $pagoactual = $input['pago'][$key];
            if ($pagoactual){
                if ($pagoactual){
                    if ($pagoactual != 0){
                        $invoice = Invoice::find($fact_id);
                        if ($invoice->total - $invoice->acuenta - $pagoactual > 0){
                            $invoice->status = "Pending";
                        }else{
                            $invoice->status = "Pagada";
                            $invoice->accounting_date =  Carbon::now();
                        }
                        $invoice->acuenta = $invoice->acuenta + $pagoactual;
                        $invoice->save();
                    }
                }
                
            } 
        }
        
        
        //$client_id = $request->input('client_id');
        //dd($request->input('pago1'));
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
    public function destroy($id)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nuevopago($id)
    {
        // 
        $client = client::find($id);
        $invoices = $client->invoices;
        //dd($invoices);
        return view('admin.payments.nuevopago')->with(compact('client','invoices'));
    }
}
