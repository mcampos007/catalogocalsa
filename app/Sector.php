<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    //$sector->products
    public function products(){

        return $this->hasMany(Product::class);
    }
    //$sector->categories
    public function categories(){

        return $this->hasMany(Category::class);
    }
}
