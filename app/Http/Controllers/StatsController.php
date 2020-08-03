<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Sale;

use App\User;

use App\Expense;

class StatsController extends Controller
{

    private $time;

    public function __construct()
    {
        $this->time=Carbon::now();
    }
    
    public function show($user_id)
    {
        $end=$this->time->copy()->toDateTimeString();
        $start=$this->time->copy()->subWeek()->toDateTimeString();
        
        $employee_id=User::find($user_id)->employee_id;

        $weekly_sale=Sale::whereBetween('created_at',[$start,$end])
                            ->where('employee_id',$employee_id)
                            ->get();

        $daily_sale=Sale::whereBetween('created_at',[$this->time->copy()->startOfDay(),$this->time->copy()->endOfDay()])
                            ->where('employee_id',$employee_id)
                            ->sum('total_amount');
        
        $weekly_expense=Expense::whereBetween('created_at',[$start,$end])
                        ->where('employee_id',$employee_id)
                        ->get();

        $daily_expense=Expense::whereBetween('created_at',[$this->time->copy()->startOfDay(),$this->time->copy()->endOfDay()])
                    ->where('employee_id',$employee_id)
                    ->sum('amount');
        
        
                    
        return response()->json(['data'=>[
            'daily_sale'=>$daily_sale,
            'daily_expense'=>$daily_expense,
            'weekly_sale'=>$weekly_sale,
            'weekly_expense'=>$weekly_expense,
        ]]);
    }

}
