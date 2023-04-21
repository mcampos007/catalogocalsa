<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    //
    // $caja->user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //$caja->puntodeventa
    public function puntodeventa(){
        return $this->belongsTo(Puntodeventa::class);
    }
    //$caja->efectivo
    public function efectivo(){
        return $this->belongsTo(Efectivo::class);
    }

    //$caja->gastos
    public function gastos(){
        return $this->hasMany(Gasto::class);
    }

    //$caja->tarjeta
    public function tarjeta(){
        return $this->hasMany(Tarjeta::class);
    }

    //$caja->otropagos
    public function otropagos(){
        return $this->hasMany(Otropago::class);
    }
    //$caja->cheques
    public function cheques(){
        return $this->hasMany(Cheque::class);
    }

    
}
