<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Employee::class,1)->create()->each(function($employee){    
        //     factory(App\Brand::class,1)->create()->each(function($brand){
        //         $product=factory(App\Product::class,1)->make(['brand_id'=>$brand]);
        //         factory(App\Invoice::class,1)->create(['employee_id'=>$employee,'total_amount'=>5*$product->]);
        //     });
        // });

        factory(App\Brand::class,2)->create()->each(function($brand){
            factory(App\Product::class,10)->create(['brand_id'=>$brand]);
        });

    }
}
