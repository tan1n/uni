<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //
    protected $table='expense';

    protected $guarded=[];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
