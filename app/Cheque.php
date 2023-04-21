<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    //$cheque->caja
     public function caja(){
         return $this->belongsTo(Caja::class);
     }
    //$cheque->client
     public function client(){
         return $this->belongsTo(Client::class);
     }

     //$cheque->banco
     public function banco(){
         return $this->belongsTo(Banco::class);
     }
     //$cheque->estadocheque
     public function estadocheque(){
         return $this->belongsTo(Estadocheque::class);
     }
}
