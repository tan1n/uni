<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        return response()->json(['data'=>Expense::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['data'=>Expense::create($request->all())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data'=>Expense::find($id)]);
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
        $expense=Expense::find($id);
        $expense->update($request->all());
        return response()->json(['data'=>$expense]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense=Employee::find($id);
        $expense->delete();
        return response()->json(['data'=>'Expense Deleted']);
    }
}
