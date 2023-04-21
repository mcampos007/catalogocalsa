<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //
    //$Gasto->caja
     public function caja(){
        return $this->belongTo(Caja::class);
    }

    public function getTotalAttribute()
    {
      $total = 0;

      foreach ($this->gastos as $gasto) 
      {
         $total += 150;  //$gasto->importe;
      }

      return $total;
    }
}
