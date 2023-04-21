<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadocheque extends Model
{
    //
    //$estadocheque->cheques:
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }
}
