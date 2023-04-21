<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    //
    //$cart->sucursal
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
