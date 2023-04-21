<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    //$paymentdetail->payment
    public function payment()
    {
    	return $this->belongsTo(Payment::class);
    }
}
