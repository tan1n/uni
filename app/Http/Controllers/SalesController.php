<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sales;

class SalesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $i=0;
        foreach($request->products as $product_id){
            Sales::create([
                'employee_id'=>$request->employee_id,
                'product_id'=>$product_id,
                'discount'=>$request->discount,
                'payment_type'=>$request->payment_type,
                'quantity'=>$request->quantity[$i]
            ]);
            $i++;
        }
        return response()->json(['data'=>'Sales created']);  
    }

}
