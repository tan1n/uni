<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;

use App\Product;

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
        // $d=$request->products;
        // dd($d);
        foreach($request->products as $product_id){
            Sale::create([
                'employee_id'=>$request->employee_id,
                'product_id'=>$product_id,
                'discount'=>$request->discount,
                'payment_method'=>$request->payment_method,
                'quantity'=>$request->quantity[$i]
            ]);
            $product=Product::find($product_id);
            $product->quantity=$product->quantity - $request->quantity[$i];
            $product->save();
            $i++;
        }
        return response()->json(['data'=>'Sales created']);  
    }

}
