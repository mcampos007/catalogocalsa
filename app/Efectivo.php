<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Efectivo extends Model
{
    //
    //$Efectivo->caja
      public function caja(){
         return $this->belongsTo(Caja::class);
     }
}
