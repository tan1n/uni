<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;

class SuppliersController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data'=>Supplier::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['data'=>Supplier::create($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data'=>Supplier::find($id)]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier=Supplier::find($id);
        $supplier->update($request->all());
        return response()->json(['data'=>$supplier]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=Supplier::find($id);
        $supplier->delete();
        return response()->json(['data'=>'Supplier Deleted']);
    }
}
