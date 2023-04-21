<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //$payment->details
    public function details()
    {
    	return $this->hasMany(PaymentDetail::class);
    }
     //$payment->invoice
     public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
    //$payment->client
    public function client(){
        return $this->belongsTo(Client::class);
    }

}
