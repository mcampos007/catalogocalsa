<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //$client->carts
    public function carts()
    {
    	return $this->hasMany(Cart::class);
    }

    //$client->invoices:
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    //$client->cheques:
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }

    //$client->otropagos:
    public function otropago()
    {
        return $this->hasMany(Otropago::class);
    }
    
}
