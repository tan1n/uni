<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded=[];

    protected $casts = ['created_at' => 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
