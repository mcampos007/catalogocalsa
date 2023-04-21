<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipomovimiento extends Model
{
    //$tipomovimiento->otropagos:
    public function otropagos()
    {
        return $this->hasMany(Otropago::class);
    }
}
