<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    //
    //$tarjeta->caja
     public function caja(){
        return $this->belongTo(Caja::class);
    }
}
