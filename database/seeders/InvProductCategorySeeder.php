<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inv_Product_Category;
use Illuminate\Support\Facades\File;

class InvProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/inv_product_category.json");
        $users = collect(json_decode($json));

        $users->each(function($user){
            Inv_Product_Category::create([
                "product_category_name"=>$user->product_category_name
            ]);
        });
    }
}
