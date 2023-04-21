<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Promotion;
use App\PromotionImage;
use File;

class PromoImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        
        $promotion = Promotion::find($id);
        $images = $promotion->images()->orderBy('featured','desc')->get();
        return view('admin.promotions.images.index')->with(compact('promotion','images'));
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
    public function store(Request $request,$id)
    {
        //
         //Guardar la imagen 
        
        $file = $request->file('photo');
        $path = public_path().'/images/products';
        $filename = uniqid().$file->getClientOriginalName();
        $moved = $file->move($path,$filename);

        //Crear Registro en BD
        if ($moved){


            $promotionImage = new PromotionImage();
            $promotionImage->image = $filename;
            //$promotionImage->featuredv= ;
            $promotionImage->promotion_id = $id;
            $promotionImage->save(); //INSERT
         }   
        return back();
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
    public function destroy(Request $request, $id)
    {
        //
        $promotionImage = PromotionImage::find($request->image_id);
        if (substr($promotionImage->image,0,4) ==="http"){
            $deleted = true;            

        }else{
            $fullPath = public_path() . '/images/products/' . $promotionImage->image;
            $deleted = File::delete($fullPath);
        }
        //Eliminar el Registro
        if ($deleted){
            $promotionImage->delete();
        }
        return back();
    }
    public function select($id, $image){

        PromotionImage::where('promotion_id',$id)->update([
            'featured' =>false
        ]);
        $promotionImage = PromotionImage::find($image);
        $promotionImage->featured = true;
        $promotionImage->save();

        return back();
    }

}

