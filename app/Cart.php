<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public function details()
    {
    	return $this->hasMany(CartDetail::class);
    }

    public function getTotalAttribute()
    {
    	$total = 0;

		foreach ($this->details as $detail) 
		{
			//$total += $detail->quantity * ($detail->product->price - $detail->product->discount/100);
            //$total += $detail->quantity * ($detail->price - $detail->price*$detail->discount/100);
            $total += $detail->price *$detail->quantity;
		}

		return $total;
    }

    //Total de Articulos
    public function getTotalitemsAttribute()
    {
        $totalitems = 0;

        foreach ($this->details as $detail) 
        {
            //$totalitems += $detail->quantity * ($detail->product->price - $detail->product->discount/100);
            //$totalitems += $detail->quantity * ($detail->price - $detail->price*$detail->discount/100);
            $totalitems += $detail->quantity;
        }

        return $totalitems;
    }

    //$cart->client
     public function client(){
         return $this->belongsTo(Client::class);
     }
     //$cart->user
     public function user(){
         return $this->belongsTo(User::class);
     }

     //$cart->invoice
     public function invoice(){
        return $this->belongTo(Invoice::class);
    }

     public function getClientNameAttribute(){
        if ($this->client)
        return $this->client->name;
        return 'Sin Asignar';

     }

      //$sucursal->cart
    public function sucursal(){

      return $this->belongsTo(Sucursal::class);
    }
     
}
