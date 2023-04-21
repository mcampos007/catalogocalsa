<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sector;
use App\Product;

class SectorController extends Controller
{
    //
    public function index()
    {
        $sectors = Sector::paginate(10);
        return view('admin.sectors.index')->with(compact('sectors'));
    }

    public function create()
    {
        //
        return view('admin.sectors.create');
    }

    public function store(Request $request)
    {
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para sector.',
            'name.min' => "Sector debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $sector = new Sector();
        $sector->name = $request->input('name');
        $sector->save();
        return redirect('/admin/sectors');

    }

    public function edit($id)
    {
        //
        $sector = Sector::find($id);
        return view('admin.sectors.edit')->with(compact('sector'));
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
        //validar
        $messages =[
            'name.required'=>'Es necesario ingresar un nombre para el sector',
            'name.min' => "El sector debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $sector = Sector::find($id);
        $sector->name = $request->input('name');
        $sector->save();     
        return redirect('/admin/sectors');

    }

    public function destroy($id)
    {
        //
          $product = Product::where('sector_id',$id)->get();
          $cant = $product->count();
          //echo $cant;
          
        //dd($product);
          if ($cant===0){
                $sector = Sector::find($id);
                $sector->delete();   
                return back(); 
          }else{
            return back()->with('msj','No se puede eliminar un Sector que tenga articulos');    
          }
        

        //  Eeliminar la Imagen asociada 
        //     
        
        
    }
}
