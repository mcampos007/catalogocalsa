<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //$product->category
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    //$product->images

    public function images(){
    	return $this->hasMany(ProductImage::class);
    }

    //$product->sector
    public function sector(){
        return $this->belongsTo(Sector::class);
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
    	return 'images/default.jpg';
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;
        return 'General';
    }
}
