<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otropago extends Model
{
    //$otropago->caja
     public function caja(){
         return $this->belongsTo(Caja::class);
     }
    //$otropago->client
     public function client(){
         return $this->belongsTo(Client::class);
     }
     //$otropago->tipomovimiento
     public function tipomovimiento(){
         return $this->belongsTo(Tipomovimiento::class);
     }
}
