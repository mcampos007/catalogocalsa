<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //$category->products
    public function products(){

    	return $this->hasMany(Product::class);
    }
    //$category->sector
    public function sector(){

        return $this->belongsTo(Sector::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
    	$featured_Image_url = $this->image;
    	if(!$featured_Image_url)
    	{
    		return 'images/default.jpg';
    	}
    	$featured_Image_url = $this->image;
	   	if (substr($this->image,0,4) === "http"){
    		return $this->image;
    	}
    	return 'images/categories/'.$this->image; 
    }
}
