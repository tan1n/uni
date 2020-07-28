<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;

class ReportsController extends Controller
{

    public function salesByDate($start,$end)
    {
        $start=$start." 00:00:00";
        $end=$end." 23:59:59";
        $data=Sale::with(['product','employee'])->whereBetween('created_at',[$start,$end])->get();
        return response()->json(['data'=>$data]);
    }

    public function salesByEmployee($employee,$start,$end)
    {
        $start=$start." 00:00:00";
        $end=$end." 23:59:59";
        $data=Sale::with(['product','employee'])
                ->whereBetween('created_at',[$start,$end])
                ->where('employee_id',$employee)->get();
        return response()->json(['data'=>$data]);
    }

    public function salesByProduct($product,$start,$end)
    {
        $start=$start." 00:00:00";
        $end=$end." 23:59:59";
        $data=Sale::with(['product','employee'])
                ->whereBetween('created_at',[$start,$end])
                ->where('product_id',$product)->get();
        return response()->json(['data'=>$data]);
    }

    public function expenseByDate($start,$end)
    {

    }

}
