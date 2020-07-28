<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::resource('product','ProductsController',['except'=>['create','edit']]);
    Route::resource('brand','BrandsController',['except'=>['create','edit']]);
    Route::resource('category','CategoriesController',['except'=>['create','edit']]);
    Route::resource('supplier','SuppliersController',['except'=>['create','edit']]);
    Route::resource('purchase','PurchasesController',['except'=>['create','edit']]);
    Route::resource('employee','EmployeesController',['except'=>['create','edit']]);
    Route::resource('expense','ExpenseController',['except'=>['create','edit']]);
    Route::resource('sales','SalesController',['only'=>['store']]);
    Route::prefix('report')->group(function(){
        Route::prefix('sales')->group(function(){
            Route::get('{start}/{end}','ReportsController@salesByDate');
            Route::get('employee/{employee}/{start}/{end}','ReportsController@salesByEmployee');
            Route::get('product/{product}/{start}/{end}','ReportsController@salesByProduct');
        });
        Route::prefix('expense')->group(function(){
            Route::get('{start}/{end}','ReportsController@expenseByDate');
            Route::get('employee/{employee}/{start}/{end}','ReportsController@expenseByEmployee');
        });
    });
});
