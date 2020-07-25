<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $guarded=[];

   public function brand()
   {
        return $this->belongsTo(Brand::class,'brand_id');
   }

   public function category()
   {
        return $this->belongsTo(Category::class,'category_id');
   }

}
