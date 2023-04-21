<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Puntodeventa;
use App\Caja;

class PuntodeventaController extends Controller
{
    //
    public function index()
    {
        $puntodeventas = Puntodeventa::paginate(10);
        return view('admin.puntodeventas.index')->with(compact('puntodeventas'));
    }

    public function create()
    {
        //
        return view('admin.puntodeventas.create');
    }

    public function store(Request $request)
    {
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para el punto de venta.',
            'name.min' => "El punto de venta debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $puntodeventa = new Puntodeventa();
        $puntodeventa->name = $request->input('name');
        $puntodeventa->save();
        return redirect('/admin/puntodeventa');
    }

    public function edit($id)
    {
        //
        $puntodeventa = Puntodeventa::find($id);
        return view('admin.puntodeventas.edit')->with(compact('puntodeventa'));
    }

    public function update(Request $request, $id)
    {
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para el punto de venta',
            'name.min' => "El punto de venta debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $puntodeventa = Puntodeventa::find($id);
        $puntodeventa->name = $request->input('name');
        $puntodeventa->save();     
        return redirect('/admin/puntodeventa');

    }

    public function destroy($id)
    {
        //
          $caja = Caja::where('puntodeventa_id',$id)->get();
          $cant = $caja->count();
          //echo $cant;
          
        //dd($product);
          if ($cant===0){
                $puntodeventa = Puntodeventa::find($id);
                $puntodeventa->delete();   
                return back(); 
          }else{
            return back()->with('msj','No se puede eliminar un Sector que tenga articulos');    
          }   
    }
}
