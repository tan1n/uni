<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function salesByDate($start,$end)
    {
        $data=Sales::with(['product','employee'])->whereDateBetween([$start,$end])->get();
        return response()->json(['data'=>$data]);
    }

    public function salesByEmployee($employee,$start,$end)
    {
        $data=Sales::with(['product','employee'])
                ->whereDateBetween([$start,$end])
                ->where('employee_id',$employee)->get();
        return response()->json(['data'=>$data]);
    }

    public function salesByProduct($product,$start,$end)
    {
        $data=Sales::with(['product','employee'])
                ->whereDateBetween([$start,$end])
                ->where('product_id',$product)->get();
        return response()->json(['data'=>$data]);
    }

}
