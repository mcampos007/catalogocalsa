<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotions = Promotion::paginate(10);
        //dd($promotions);
        return view('admin.promotions.index')->with(compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        //$categories = Category::all();
        //return view('admin.products.create')->with(compact('categories'));
        return view('admin.promotions.create');
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
         //VALIDAR
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe terner al menos tres caracteres',
            'description.required' => 'Es necesario ingresar la descripción del Producto',
            'description.max' => 'La longitud de la descripción no puede tener mas de 200 car.',
            'price.required' => 'Es necesario ingresar el precio para el producto',
            'price.numeric' => 'El precio debe ser un numero ',
            'price.min' => 'el precio debe ser mayor que Cero',
            //'category_id.required' => 'Se debe Selecionar una Categoria',
            //'category_id.min' => 'Se debe Selecionar una Categoria'
        ];
        $rules= [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0',
            //'category_id'=>'required|min:1'
            
        ];
        $this->validate($request, $rules,$messages);
        //dd($request->all());
        $promotion = new Promotion();
        $promotion->name  = $request->input('name');
        $promotion->description  = $request->input('description');
        $promotion->price  = $request->input('price');
        $promotion->long_description  = $request->input('long_description');
        //$promotion->category_id = $request->input('category_id');
        $promotion->save();
        return redirect('/admin/promotions');
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
        $promotion = Promotion::find($id);
        //$categories = Category::all();
        return view('admin.promotions.edit')->with(compact('promotion'));
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
         //VALIDAR
        $messages=[
            'name.required' => 'Es necesario ingresar un nombre para el producto',
            'name.min' => 'El nombre del producto debe terner al menos tres caracteres',
            'description.required' => 'Es necesario ingresar la descripción del Producto',
            'description.max' => 'La longitud de la descripción no puede tener mas de 200 car.',
            'price.required' => 'Es necesario ingresar el precio para el producto',
            'price.numeric' => 'El precio debe ser un numero ',
            'price.min' => 'el precio debe ser mayor que Cero'
        ];
        $rules= [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
            
        ];
        $this->validate($request, $rules,$messages);
        //
        $promotion = Promotion::find($id);
        $promotion->name  = $request->input('name');
        $promotion->description  = $request->input('description');
        $promotion->price  = $request->input('price');
        $promotion->long_description  = $request->input('long_description');
       // $promotion->category_id = $request->input('category_id');
        $promotion->save(); //UPDATE
        return redirect('/admin/promotions');
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
        $promotion = Promotion::find($id);
        $promotion->delete();
        return back();
    }
}

