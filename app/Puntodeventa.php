<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntodeventa extends Model
{
   //$puntodeventa->cajas
    public function cajas(){
        return $this->hasMany(Caja::class);
    }
}
