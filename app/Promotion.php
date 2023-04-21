<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
     //
     //$product->images

     public function images(){
    	return $this->hasMany(PromotionImage::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
    	$featuredImage = $this->images()->where('featured',true)->first();
    	if (!$featuredImage)
    	{
    		$featuredImage = $this->images()->first();
    	}
    	if ($featuredImage){
    		return $featuredImage->url;
    	}
    	//Default
    	return '/images/default.jpg';
    }
}
