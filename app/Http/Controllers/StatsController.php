<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use DB;

use App\Sale;

use App\Invoice;

use App\User;

use App\Expense;

use App\Brand;

use App\Product;

use App\Purchase;

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

        $monthly_sale=Invoice::select(DB::raw('sum(total_amount) as total,CAST(created_at AS DATE) as date'))
                    ->whereBetween('created_at',[$this->time->copy()->startOfMonth(),$this->time->copy()->endOfMonth()])
                    ->where('employee_id',$employee_id)
                    ->groupBy(DB::raw('CAST(created_at AS DATE)'))
                    ->get();


        $weekly_sale=Invoice::select(DB::raw('sum(total_amount) as total,CAST(created_at AS DATE) as date'))
                    ->whereBetween('created_at',[$start,$end])
                    ->where('employee_id',$employee_id)
                    ->groupBy(DB::raw('CAST(created_at AS DATE)'))
                    ->get();

        $daily_sale=Invoice::whereBetween('created_at',[$this->time->copy()->startOfDay(),$this->time->copy()->endOfDay()])
                            ->where('employee_id',$employee_id)
                            ->with('employee')
                            ->get();
        
        $weekly_expense=Expense::whereBetween('created_at',[$start,$end])
                        ->where('employee_id',$employee_id)
                        ->get();

        $daily_expense=Expense::whereBetween('created_at',[$this->time->copy()->startOfDay(),$this->time->copy()->endOfDay()])
                    ->where('employee_id',$employee_id)
                    ->sum('amount');

        $monthly_expense=Expense::whereBetween('created_at',[$this->time->copy()->startOfMonth(),$this->time->copy()->endOfMonth()])
                        ->where('employee_id',$employee_id)
                        ->sum('amount');

        $total_products=Product::all()->count();

        $total_brands=Brand::all()->count();

        $daily_purchase=Purchase::whereBetween('created_at',[$this->time->copy()->startOfDay(),$this->time->copy()->endOfDay()])
                        ->sum('cost');

        $weekly_purchase=Purchase::whereBetween('created_at',[$start,$end])
                        ->sum('cost');

        $monthly_purchase=Purchase::whereBetween('created_at',[$this->time->copy()->startOfMonth(),$this->time->copy()->endOfMonth()])
                        ->sum('cost');

                    
        return response()->json(['data'=>[
            'daily_sale'=>$daily_sale,
            'daily_expense'=>$daily_expense,
            'daily_purchase'=>$daily_purchase,
            'weekly_sale'=>$weekly_sale,
            'weekly_expense'=>$weekly_expense,
            'weekly_purchase'=>$weekly_purchase,
            'monthly_sale'=>$monthly_sale,
            'monthly_expense'=>$monthly_expense,
            'monthly_purchase'=>$monthly_purchase,
            'total_products'=>$total_products,
            'total_brands'=>$total_brands,
            'monthly_sale_total'=>$monthly_sale->sum('total'),
            'weekly_sale_total'=>$weekly_sale->sum('total'),
            'daily_sale_total'=>$daily_sale->sum('total_amount')
        ]]);
    }

}
