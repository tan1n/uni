<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $guarded=[];

    protected $casts = ['created_at' => 'date'];

    public function sales()
    {
        return $this->hasMany(Sale::class,'invoice_id');
    }
}
