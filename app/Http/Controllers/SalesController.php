<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;

use App\Product;

use App\Invoice;

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
        // dd($request->all());

        $invoice=Invoice::create([
            'employee_id'=>$request->employee_id,
            'discount'=>$request->discount,
            'total_amount'=>$request->total_amount,
            'payment_method'=>$request->payment_method
        ]);

        foreach($request->products as $product_id){
            $product=Product::find($product_id);
            Sale::create([
                'employee_id'=>$request->employee_id,
                'product_id'=>$product_id,
                'quantity'=>$request->quantity[$i],
                'total_amount'=>intval($product->price)*intval($request->quantity),
                'invoice_id'=>$invoice->id
            ]);
            $product->quantity=$product->quantity - $request->quantity[$i];
            $product->save();
            $i++;
        }
        return response()->json(['data'=>'Sales created']);  
    }

}
