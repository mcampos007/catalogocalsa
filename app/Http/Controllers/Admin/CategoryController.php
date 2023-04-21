<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;
use App\Sector;
use App\Product;
use File;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
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
            'name.required'=>'Es necesario ingresar un nombre para la categoria',
            'name.min' => "La Categoria debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        $file = $request->file('image');
        if ($file)
        {
            $path = public_path().'/images/categories';
            $filename = uniqid().$file->getClientOriginalName();
            $moved = $file->move($path,$filename);

            //Crear Registro en BD
            if ($moved){
                $category->image = $filename;
             }   
         }
        $category->save();
        return redirect('/admin/categories');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category)
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
        $category = Category::find($id);
        $sectors = Sector::all();
        return view('admin.categories.edit')->with(compact('category', 'sectors'));
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
            'name.required'=>'Es necesario ingresar un nombre para la categoria',
            'name.min' => "La Categoria debe tener al menos tres letras"
        ];
        
        //Reglas
        $rules = [
            'name' => 'required|min:3'

        ];

        $this->validate($request,$rules, $messages);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        $file = $request->file('image');
        $eliminar_anterior = false;
        if ($file)
        {
            $path = public_path().'/images/categories';
            $filename = uniqid().$file->getClientOriginalName();
            $moved = $file->move($path,$filename);
            $eliminar_anterior = false;
            if ($category->image)
            {
                $previousPath = $path .'/'. $category->image;
                $eliminar_anterior = true;
            }
            //Crear Registro en BD
            if ($moved){
                $category->image = $filename;
             }   
         }

        $category->save();
        if ($eliminar_anterior)
        {
            File::delete($previousPath);
        }
        return redirect('/admin/categories');

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
          $product = Product::where('category_id',$id)->get();
          $cant = $product->count();
          //echo $cant;
          
        //dd($product);
          if ($cant===0){
                $category = Category::find($id);
                $category->delete();   
                return back(); 
          }else{
            return back()->with('msj','No se puede eliminar una Categoria que tenga articulos');    
          }
        

        //  Eeliminar la Imagen asociada 
        //     
        
        
    }
}
