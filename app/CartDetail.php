<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    //
    protected $appends = ['Preciocon_Descuento'];
    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function getPrecioconDescuentoAttribute()
    {

        return $this->price - $this->price*$this->discount/100;
        //return $new_price;
  
    }
}

