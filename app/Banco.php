<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    //
    //$banco->cheques:
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }
}
